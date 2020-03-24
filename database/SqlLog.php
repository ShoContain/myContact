<?php
DB::enableQueryLog();

function sql(){
  return DB::getQueryLog();
}
 
