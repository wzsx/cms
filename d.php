<?php
//桶排序
$arr=array(1,3,5,7,9,10,11);
$min=min($arr);
$max=max($arr);
$chunk =array();
for($i=$min;$i<=$max;$i++){
    $chunk[$i]=0;
}
foreach($arr as $value){
    $chunk[$value]=$chunk[$value]+1;
}
foreach($chunk as $key=>$val){
    if($val>0){
        for($j=0;$j<$val;$j++){
            echo "<hr/>";
            echo $key;
        }
    }
}
echo "<br>";
$num=0;
for($i=1;$i<=100;$i++){
$num=$num+$i;
}
echo $num;
echo "<br>";

//F[n]=F[n-1]+F[n-2](n>=3,F[1]=1,F[2]=1)
$arr=array();
$arr[1]=1;
$arr[0]=1;
for($i=2;$i<=100;$i++){
    $arr[$i]=$arr[$i-1]+$arr[$i-2];
}
print_r($arr);


$arr=array(7,4,10,30,2);
for($i=0;$i<count($arr);$i++){
    for($j=0;$j<count($arr)-1;$j++){
        if($arr[$j]>$arr[$j+1]){
            $tmp = $arr[$j];
            $arr[$j]=$arr[$j+1];
            $arr[$j+1]=$tmp;
        }
    }
}
print_r ($arr);

// F0=0，F1=1，Fn=F(n-1)+F(n-2)（n>=2，n∈N*）

f(100)=
?>