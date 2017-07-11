<?php
class Path
{
    public $currentPath;

    function __construct($path)
    {
        $this->currentPath = $path;
    }

    public function cd($newPath)
    {
       
        $path = "";
        if(substr($newPath, 0, 1) == "/")
        {
            $this->currentPath = $newPath;
            $path = $this->currentPath;
        }
        
        else
        {
        $path = $this->currentPath . "/" . $newPath;
        }

        $arr = explode("/", $path);
        $arr = array_filter($arr);
        $arr = array_values($arr);

        $count = 0;
        $len = count($arr) - 1;
        for($i = $len; $i >=0; $i--)
        {
            for($j = 1; $j <= $count && $arr[$i] !=".."; $j++)
                {
                    unset($arr[$i]);
                    $i--;
                }
            
            if($arr[$i] == '..')
            {
                
                #echo "inside"." ";
                $count++;
                unset($arr[$i]);
                continue;
            }
            else if($arr[$i] == '.')
            {
                unset($arr[$i]);
                continue;
            }
            
           else
            {
                $count = 0;
             
                
            }
            
            
        }
        $this->currentPath = "/".implode('/', $arr) ;
       
    }
}

$path = new Path('/a/b/c/d');
$path->cd('../x');
echo $path->currentPath;

