<?php
/*
Клиентская библиотека для работы с wappc.biz
Все подробности по установке и настройке на сайте проекта
Внимание! Модификация этого скрипта запрещена.
В случае внесения изменений не гарантируем нормальную работу.
Версия от 14.11.2009. Новые алгоритмы антинакрутки, защита паролем и защита от вывода рекламы одного сайта в одном блоке.
Автор:Denvas
http://bmatrix.net/
*/

    //==================================================//
    /*
    Функция забирает данные с wappc.ru и возвращает код, который нужно вывести на экран
    */
    function GetFeedWAPPC3($num,$wappc_config){
        global $wappc3_curl, $wappc3_data, $wappc3_randkeys, $wappc3_dataip, $wappc3_select, $wappc3_pwdtech;

        $namestat=H."sys/tmp/wappc3_".$wappc_config["aff"]."_stat.dat";
        $nametemp=H."sys/tmp/wappc3_".$wappc_config["aff"]."_".md5($wappc_config["charset"].(isset($wappc_config["script"])?$wappc_config["script"]:"")).".dat";

        //еще не загружена реклама в память
        if(empty($wappc3_data)){
            if(!isset($wappc3_randkeys))$wappc3_randkeys=array("-1","0");
            $content="";
        
            if(file_exists($nametemp)){
                $content=file_get_contents($nametemp);
                $oldtime=(int)substr($content,0,strpos($content,"\n"));
                $content=substr($content,strpos($content,"\n")+1);
            } else $oldtime=0;
        
            if(time()-$oldtime>5*60){//кешировать на 5 минут (чаще запрашивать нельзя, сервер будет блокировать запросы)
                $statadv=@file_get_contents($namestat);
                $fd=fopen($namestat,"wb");
                if(!$fd)return "error 1";
                fwrite($fd,"");
                fclose($fd);
        
                $url="http://wappc.biz/feed.php?charset=".$wappc_config["charset"]."&pwd=".(empty($wappc3_pwdtech)?"":urlencode($wappc3_pwdtech))."&uid=".$wappc_config["aff"]."&t=".time()."&page=".urlencode(@$_SERVER["HTTP_HOST"].@$_SERVER["REQUEST_URI"])."&post=".(empty($_POST)?0:1)."&stat=".urlencode($statadv).(isset($_SERVER['HTTP_REFERER'])?("&ref=".strtr($_SERVER['HTTP_REFERER'],array("\r"=>"","\n"=>"","|"=>""))):"").(isset($wappc_config["script"])?("&script=".urlencode($wappc_config["script"])):"");
                if(!empty($wappc_config["tb"]))$url.="&tb=1";

                if(empty($wappc3_curl)){
                    //забор средствами php
                    $html=@file_get_contents($url);
                }
                else{
                    //забор курлом (в случае отсутствия коннекта отваливается через 10 секунд)
                    $ch=curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
                    $html=curl_exec($ch);
                    curl_close($ch);
                };
                if($html)$content=$html;//новые данные
				elseif(time()-$oldtime>15*60)$content="";//старые данные можно показывать не больше 15 минут
                //кэширование
				$fd=fopen($nametemp,"wb");
				if(!$fd)return "error 2";
				fwrite($fd,time()."\n".$content);
				fclose($fd);
            };//if
            $data=ParseResultWAPPC3($content,$wappc_config);
            $wappc3_data=$data;
        }
        else{
            $data=$wappc3_data;
        };

        $ndata=count($data);
        $code=array();
        //распределеные вывода рекламы. самые дорогие рекламные кампании показываются чаще, чем дешевые
        if($ndata>0){
            $allbid=0;
            for($i=0;$i<$ndata;$i++)$allbid+=$data[$i][1];
            if($num>$ndata)$num=$ndata;
			$arrcheck=array();
            //случайный выбор
            if(empty($wappc_config["topbid"])){
                $rand_keys=array();
                for($j=0;$j<$num;$j++){
                    $nrand=0;
                    do{
                        $rnd=mt_rand(0,round($allbid*100))/100;
                        $flag=0;
                        for($i=0;$i<$ndata;$i++){
                            $curbid=$data[$i][1];
                            if($curbid>=$rnd){$flag=$data[$i][6];$iflag=$i;break;};
                            $rnd-=$curbid;
                        };
                        $nrand++;
                    }while(((isset($wappc3_randkeys[$flag]))||(isset($arrcheck[$data[$iflag][2]])))&&($nrand<10));
                    if($nrand>=10)break;
					$arrcheck[$data[$iflag][2]]=1;//занести адрес
                    $wappc3_randkeys[$flag]=1;
                    $rand_keys[]=$iflag;
                };//for($j=0;$j<$num;$j++)
            }
            //по порядку от самой дорогой, до самой дешевой
            else{
                $i=0;
                for($j=0;$j<$num;$j++){
                    $nrand=0;
                    do{
                        $iflag=$i;
                        $i++;if($i>$ndata){$iflag=-1;break;};
                        $flag=$data[$iflag][6];
                        $nrand++;
                    }while(((isset($wappc3_randkeys[$flag]))||(isset($arrcheck[$data[$iflag][2]])))&&($nrand<10));
                    if($nrand>=10)break;

                    if($iflag>=0){
						$arrcheck[$data[$iflag][2]]=1;//занести адрес
                        $wappc3_randkeys[$flag]=1;$rand_keys[]=$iflag;
                    }
                    else{
                        break;
                    }
                };//for($j=0;$j<$num;$j++)
            };//else
            if(empty($rand_keys))return empty($wappc_config["empty"])?"":$wappc_config["empty"];//нет данных

            if(empty($wappc_config["template"]))$wappc_config["template"]='%code%';
            //подсчет статистики
            $statadv=@file_get_contents($namestat);
            if(!empty($statadv))$statadv=unserialize($statadv);
            if($num>count($rand_keys))$num=count($rand_keys);
            $wappc3_select=array();
            //вывод кода
            for($i=0;$i<$num;$i++){
                $slink=$data[$rand_keys[$i]];
                $id_link=$slink[6];
                $wappc3_select[]=$slink;//выбранные данные
                if(isset($statadv[$id_link]))$statadv[$id_link]++; else $statadv[$id_link]=1;
                $code[]=strtr($wappc_config["template"],array('%code%'=>$slink[0]));
            };//for
			if(!empty($_POST))if(isset($statadv["0.post"]))$statadv["0.post"]++; else $statadv["0.post"]=1;
            $fd=fopen($namestat,"wb");
            if(!$fd)return "error 3";
            fwrite($fd,serialize($statadv));
            fclose($fd);
            return join($wappc_config["sep"],$code);
        };//if($ndata>0)
        return empty($wappc_config["empty"])?"":$wappc_config["empty"];//нет данных
    };//function 
    //==================================================//
    /*
    Функция разбирает данные и возвращает массив
    Обрабатывает фильтры.
    Внимание! Эти фильтры еще раз проверяются при клике. Если Вы измените этот код и с вашего аккаунта будут идти нефильтрованные клики, то они не будут учитываться.
    Просьба. Если хотите, чтоб не было проблем с учетом кликов, не изменяйте эту функцию.
    */
    function ParseResultWAPPC3($content,$wappc_config){

        if(empty($content))return array();

        //полезные параметры для фильтрации рекламы
        $user_agent=(isset($_SERVER['HTTP_USER_AGENT'])?strtr(strtolower($_SERVER['HTTP_USER_AGENT']),array("\r"=>"","\n"=>"","|"=>"")):"");
        $ip=(isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"");
        $ipproxy=(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))?@$_SERVER["HTTP_X_FORWARDED_FOR"]:"";
        if(strpos($user_agent,"opera mini")!==false){
            $user_agent="opera mini".(isset($_SERVER["HTTP_X_OPERAMINI_PHONE_UA"])?(" ".strtolower($_SERVER["HTTP_X_OPERAMINI_PHONE_UA"])):"");
        };//if
        $referer=isset($_SERVER['HTTP_REFERER'])?strtr(strtolower($_SERVER['HTTP_REFERER']),array("\r"=>"","\n"=>"","|"=>"")):"";
        //роботы или анонимные прокси
        if((empty($user_agent))||(strpos($user_agent,"http://")!==false)){
            $ver="robots";
            return array();//роботы нам не нужны
        }
        //опера мини
        elseif(strpos($user_agent,"opera mini")!==false)
            $ver="opera";
    	//смартфоны
		elseif(strpos($user_agent,"symbian")!==false)
			$ver="cellxhtml";
        //баузеры с компа
        elseif((strpos($user_agent,"mozilla")===0)||(strpos($user_agent,"windows")!==false))
            $ver="comp";
        //это наверное какието сотовые версии wap2
        elseif((isset($_SERVER["HTTP_ACCEPT"]))&&(strpos($_SERVER["HTTP_ACCEPT"],"xhtml")!==false))
            $ver="cellxhtml";
        //остаток будем считать старыми сотовыми с поддержкой только wml
        else
            $ver="cellwml";
        $lang=empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])?"":$_SERVER['HTTP_ACCEPT_LANGUAGE'];
        
        global $wappc3_operator;
        if(empty($wappc3_operator)){
            $operator=wappc3_getoperator($ip,$ipproxy,$wappc_config);
            $wappc3_operator=$operator;
        }
        else{
            $operator=$wappc3_operator;
        };

        //разбор данных
        $data=array();
        $lines=explode("\n",$content);
        $nlines=count($lines);
        for($j=1;$j<$nlines;$j++){
            $line=trim($lines[$j]);
            $elem=explode("|",$line);
            if(count($elem)<7)continue;
            if(OneFilterWAPPC3($ver,$elem[3]))continue;
            if(OneFilterWAPPC3($user_agent,$elem[4]))continue;
            if(OneFilterWAPPC3($ip,$elem[5]))continue;
            if(OneFilterWAPPC3($lang,$elem[7]))continue;
            if(OneFilterWAPPC3($operator,$elem[9]))continue;
            $data[]=$elem;
        };//for($j=1;$j<$nlines;$j++)
        return $data;
    };//function 
    //==================================================//
    /*
    Обработка одного фильтра
    */
    function OneFilterWAPPC3($data,$filter){
        if(strlen($filter)<1)return false;
        if($filter[0]=='!'){$flag_flt=2;$filter=substr($filter,2);} else $flag_flt=1;
        $arr=explode(";",$filter);
        $flag=false;
        $narr=count($arr);
        for($i=0;$i<$narr;$i++){
            if(empty($arr[$i]))continue;
            if(strpos($data,$arr[$i])!==false){$flag=true;break;};
        };
        if($flag){
            if($flag_flt==2){return true;};
        }
        else{
            if($flag_flt==1){return true;};
        };
        return false;
    };//function OneFilter($data,$filter)
    //==================================================//
    function wappc3_IPnormal($ip){
        $str=explode(".",$ip);
        return str_pad($str[0],3,"0",STR_PAD_LEFT).".".str_pad($str[1],3,"0",STR_PAD_LEFT).".".str_pad($str[2],3,"0",STR_PAD_LEFT).".".str_pad($str[3],3,"0",STR_PAD_LEFT);
    };
    //==================================================//
    function wappc3_loadoperator($wappc_config){
        global $wappc3_dataip, $wappc3_curl;
        //$nametemp=rtrim($wappc_config["temp"],"/");
        //if(strpos($nametemp,"/")===false)$nametemp=dirname(__FILE__)."/".$nametemp;

        //загрузка базы IP
        $wappc3_dataip=array();
        $nameip=H."sys/tmp/ip.wappc.dat";
        if(file_exists($nameip)){
            $content=file($nameip);
            $oldtime=(int)$content[0];
            $wappc3_dataip=unserialize($content[1]);
        }
        else
            $oldtime=0;
        if(time()-$oldtime>3*24*60*60){
            $url="http://wappc.biz/exportip.php";
			if(empty($wappc3_curl)){
				//забор средствами php
				$html=@file_get_contents($url);
			}
			else{
				//забор курлом (в случае отсутствия коннекта отваливается через 10 секунд)
				$ch=curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
				$html=curl_exec($ch);
				curl_close($ch);
			};
			
            if(strpos($html,"ok:")!==false){
                $html=explode("\n",$html);
                $fd=fopen($nameip,"wb");
                if($fd){fwrite($fd,time()."\n".$html[1]);fclose($fd);};
                $wappc3_dataip=unserialize($html[1]);
            };
        };//if(time()-$oldtime>10*24*60*60)
    };
    //==================================================//
    function wappc3_getoperator($ip,$ipproxy,$wappc_config){
        global $wappc3_dataip;
        if(!isset($wappc3_dataip))wappc3_loadoperator($wappc_config);
        if(($ipproxy)&&((strpos($ip,"195.189.142.")===0)||(strpos($ip,"195.189.143.")===0)||(strpos($ip,"91.203.96.")===0)||(strpos($ip,"94.246.126.")===0)||(strpos($ip,"94.246.127.")===0))){
            $ipproxy=explode(",",$ipproxy);
            $ipcheck=wappc3_IPnormal($ipproxy[0]);
            $pref="";
        }
        else{
            $ipcheck=wappc3_IPnormal($ip);
            $pref="";
        };
        $nbase=count($wappc3_dataip);
        for($i=0;$i<$nbase;$i++){
            $row=&$wappc3_dataip[$i];
            if((strcmp($row[0],$ipcheck)<=0)&&(strcmp($row[1],$ipcheck)>=0))return $pref.$row[4];
        };
        return $pref."other";
    };

?>