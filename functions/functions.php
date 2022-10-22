<?php
/**FUNCTION CHECK DUPLICATE VALUES  */
function  isExistValueInSchema(string $schemaName,string $name,string $postName,$database,string $id=null){
    $flag=false;
    
    $exist=$database->getReference($schemaName)->getChildKeys();//GET CHILD KEYS
            for ($i=0; $i <count($exist) && !$flag ; $i++) { 
                if($id==null){
                $childValues=$database->getReference("$schemaName/".$exist[$i])->getValue();//GET CHILD VALUES
                
                
               if(trim($childValues[$name])===trim($postName))//CHECK IF VALUES EQUALS
               $flag=true;
                }
                else{
                    if($exist[$i]==$id){
                        $flag=true;
                    }
                    $childValues=$database->getReference("$schemaName/".$exist[$i])->getValue();
                    if(trim($childValues[$name])===trim($postName))
               $flag=true;
                }
            }
            return $flag;
        }
?>