<?php

$source = '<?xml version="1.0" encoding="utf-8"?>
<result>
   <studentname>
      MA Razzaque
   </studentname>
   <institute>
      RUET
   </institute>
   <dept>
      CSE
   </dept>
   <roll>
      99315
   </roll>
   <class>
      First
   </class>
   
   <test>
       <this a="b">
        <is c="d">
           <a e="f" g="h"> first test</a>
        </is>
         <is>
           <b hello="world">second test</b>
        </is>
       </this>
   </test>
   
</result>';

class test {
   public $arrayData;  
   public $out;   
   function xml2array1 ($xml){
       require_once "class.xmltoarray.php";
       $xmlObj    = new XmlToArray($xml);
       $arrayData = $xmlObj->createArray();
       return $arrayData;
   }
   function xml2array1display ($xml){
       $arrayData=$this->xml2array1 ($xml);
       echo "<pre>";
       print_r($arrayData);
       echo "</pre>";
	   echo "<br><hr>";
   }
   function xml2array1time ($xml,$k){
        $time=time();
        for($i;$i<$k;$i++){
            $arrayData=$this->xml2array1 ($xml);
		}
		$time=time()-$time;
        echo "seconds ".$time."<br><hr>";
		echo "<hr>";
   }
   function xml2array1available (){   
        $sign = array(
		array_push,
		xml_parser_create,
	    xml_parser_set_option,
		xml_parser_set_option,
		xml_parse_into_struct,
		xml_parser_free	
		
		);
		foreach ($sign as $val) { 
		    if (function_exists($val)) {
               echo "functions are available:  ".$val."<br />\n";
            } else {
               echo "!!!__functions are not available:  ".$val."<br />\n";
            }
		}
		echo "<br><hr>";
	}
   
  //=====
  function xml2array2 ($xml2){
       require_once "lib.xml.php";       
       $xml = new Xml;
       $out = $xml->parse($xml2, NULL);       
       return $out;
   }
    function xml2array2display ($xml2){
       $out=$this->xml2array1 ($xml2);
       echo "<pre>";
       print_r($out);
       echo "</pre>";
	   echo "<br><hr>";
   }
   function xml2array2time ($xml,$k){
        $time=time();
        for($i;$i<$k;$i++){
            $arrayData=$this->xml2array2 ($xml);
		}
		$time=time()-$time;
        echo "seconds ".$time."<br><hr>";
		echo "<hr>";
   }
   function xml2array2available (){   
        $sign = array(
		
	    xml_parser_create,		
		xml_parser_set_option,
		xml_set_object,
		xml_set_element_handler,
		xml_set_character_data_handler,	
		   
			
			xml_parser_free,
			xml_get_error_code,
			xml_get_current_line_number		
		
		);
		foreach ($sign as $val) { 
		    if (function_exists($val)) {
               echo "functions are available:  ".$val."<br />\n";
            } else {
               echo "!!!__functions are not available:  ".$val."<br />\n";
            }
		}
		echo "<br><hr>";
		
	}
}
$t2=new test;
$t2->xml2array2available();
$t2->xml2array2($source);
$t2->xml2array2display($source);
$t2->xml2array2time($source,10000); //10000 

$t1=new test;
$t1->xml2array1available();
$t1->xml2array1($source);
$t1->xml2array1display($source);
$t1->xml2array1time($source,10000); //10000 





?>