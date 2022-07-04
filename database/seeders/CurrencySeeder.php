<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $currencyList = array(
  array(name=>'Bitcoin', 'symbole'=>'btc','fee'=>100),
  array(name=>'Ethereum', 'symbole'=>'eth','fee'=>250),
  array(name=>'Tron', 'symbole'=>'trx','fee'=>10),
 );
          DB::table('currencies')->insert($currencyList);  
    }
}
