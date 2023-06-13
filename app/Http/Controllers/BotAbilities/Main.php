<?php

namespace App\Http\Controllers\BotAbilities;

use App\Http\Controllers\BotFunctions\GeneralFunctions as BotFunctionsGeneralFunctions;
use App\Http\Controllers\BotFunctions\TextMenuSelection;
use App\Models\ScheduleMenu;
use Illuminate\Http\Request;


class Main extends BotFunctionsGeneralFunctions implements AbilityInterface
{

    public $steps = ["begin_func", "check_for_selection", "perform_selection"];
    public $menu_items_arr = ["Place Pick Up Order", " Settin"];



    public function begin_func()
    {
        // echo"loozp";

        
       $obj = $this->MenuArrayToObj($this->menu_items_arr);


        $menu = new TextMenuSelection($obj);
        $menu->send_menu_to_user("Select from our main menu");
        $this->set_session_route("Main");
        $this->go_to_next_step();
        $this->ResponsedWith200();
    }

    public function check_for_selection()
    {
       
        $menu_data = $this->menu_items_arr;
        $menu_data = $this->MenuArrayToObj($menu_data);
        $TextMenu_obj = new TextMenuSelection($menu_data, $this->userphone, $this->username);
        $TextMenu_obj->check_expected_response($this->user_message_original);

        $this->go_to_next_step();
        $this->continue_session_step();
    }


    public function perform_selection()
    {

       
    }


    function call_method($key)
    {
        $method_name = $this->steps[$key];
        $this->$method_name();
    }

    public static function test_main()
    {
        return "ok";
    }



}
