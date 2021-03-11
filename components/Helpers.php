<?php
namespace app\components;
use yii\helpers\Html;
use Yii;
class Helpers
{
	
	public static function randomString($numerical=FALSE) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 9; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$s= uniqid($randomString,true);
		$hex = substr($s, 0, 13);
		$dec = $s[13] . substr($s, 15); // skip the dot
		$unique = base_convert($hex, 16, 36) . base_convert($dec, 10, 36);
		if($numerical){$string=ltrim(crc32($unique.date('dmyhis')),'-');}else{$string=$unique;}
		
		if($string == null || $string == ''){
			return 'RAND'.time();
		}else{
			return $string;
		} //$string != null?$string:'TUM'.time();
	}
	public static function mkButton($param,$options=[]){
		$param=self::initOptions($param);
		if($param['name']['type']=='icon'){
			$name='<i class="fa '.$param['name']['icon'].'"></i>';
		}elseif ($param['name']['type']=='text') {
			$name=$param['name']['text'];
		}elseif ($param['name']['type']=='iconText') {
			$name='<i class="fa '.$param['name']['icon'].'"></i> '.$param['name']['text'];
		}
		
		if($param['type']=='modal'){
			$options = 
				[
                    'value' => $param['url'], 
                    'class' => 'btn btn-'.$param['btnSize'].' btn-'.$param['theme'].' loadModal',
                    'size' => 'modal-'.$param['size'],
                    'heading'=>$param['modalTitle'],
                    
                ];
			if(isset($param['tooltip'])){
				$options =array_merge($options,[
					'data-original-title'=>$param['tooltip']['title'],
	                'data-toggle'=>'tooltip',
	                'data-placement'=>$param['tooltip']['position']
	            ]);
			}
			$button = Html::button($name,$options);
		}elseif($param['type']=='static'){
			$options = 
				[
                    'class' => 'btn btn-'.$param['btnSize'].' btn-'.$param['theme'].' '.$param['status'],
                    //'type' => 'button',
                    
                ];
			if(isset($param['tooltip'])){
				$options =array_merge($options,[
					'data-original-title'=>$param['tooltip']['title'],
	                'data-toggle'=>'tooltip',
	                'data-placement'=>$param['tooltip']['position']
	            ]);
			}
			$button = Html::button($name,$options);
		}elseif($param['type']=='submit'){
			$options = 
				[
                    'class' => 'btn btn-'.$param['btnSize'].' btn-'.$param['theme'].' '.$param['status'],
                    
                ];
			if(isset($param['tooltip'])){
				$options =array_merge($options,[
					'data-original-title'=>$param['tooltip']['title'],
	                'data-toggle'=>'tooltip',
	                'data-placement'=>$param['tooltip']['position']
	            ]);
			}

			$button = Html::submitButton($name, $options);
		}elseif($param['type']=='reset'){
			$options = 
				[
                    'class' => 'btn btn-'.$param['btnSize'].' btn-'.$param['theme'].' '.$param['status'],
                    
                ];
			if(isset($param['tooltip'])){
				$options =array_merge($options,[
					'data-original-title'=>$param['tooltip']['title'],
	                'data-toggle'=>'tooltip',
	                'data-placement'=>$param['tooltip']['position']
	            ]);
			}

			$button = Html::resetButton($name, $options);
		}elseif ($param['type']=='link') {
			if(isset($param['data'])){
			$options = 
				[
                    'data' => [
                    			'confirm'=>$param['data']['confirm'],
                    			'method'=>'post',
                    			'data-pjax'=>false,
                    ], 
                ];
            }
			if(isset($param['tooltip'])){
				$options =array_merge($options,[
					'data-original-title'=>$param['tooltip']['title'],
	                'data-toggle'=>'tooltip',
	                'data-placement'=>$param['tooltip']['position']
	            ]);
			}
			$button = Html::a('<span class="btn btn-'.$param['btnSize'].' btn-'.$param['theme'].' '.$param['status'].'">'.$name.'</span>',$param['url'],$options);
		}
		return $button;
		
	}
	/*public static function getFields($options){
		$result = self::initOptions($options);
		 if($options['allowed']!=null){
			$allowed = $options['allowed'];;
			return array_filter( $result, function ($key) use ($allowed) { return in_array($key, $allowed);},
			    ARRAY_FILTER_USE_KEY);
		 }else{
		 	return $result;
		 }
	}*/
	protected static function initOptions($clientOptions=[])
    {
    	$options = [
        			'theme'			=> 	'primary',
        			'status'		=> 	'',
        			'url'			=> 	'/',
        			'size'			=>  'md',
        			'btnSize'		=>  'xs',
        			'modalTitle'	=>  'Modal Title',
    			];
        return $options = array_merge($options, $clientOptions);
    }





	
}