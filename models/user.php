<?php

    Class user extends Model{

        protected $table='users';
        protected $allowedFields=['name','acount','pwd','level'];

    }

?>