<?php
require_once(DIR_MODEL . 'model_vote.php');
class Admin_Controller_Vote_Setting
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'Create'));
    }

    // PHAN TAO MENU CON TRONG MENU CHA CUNG LA POST TYPE
    public function Create()
    {
        $parent_slug = 'vote';
        $page_title = '投票設定';
        $menu_title = '投票設定';
        $capability = 'manage_categories';
        $menu_slug = 'votesetting';
        add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, array($this, 'dispatchActive'));
    }

    public function dispatchActive()
    {
        //        echo __METHOD__;
        $action = getParams('action');
        switch ($action) {
            case 'title':
                $this->titleAction();
                break;
            case 'jianshi':
                $this->jianshiAction();
                break;
            case 'lishi':
                $this->lishiAction();
                break;
            case 'vote':
                $this->voteAction();
                break;
            case 'export':
                $this->exportAction();
                break;
            default:
                $this->displayPage();
                break;
        }
    }

    public function displayPage()
    {
        require_once(DIR_VIEW . 'view_vote_setting.php');
    }

    public function titleAction()
    {
        update_option('_vote_title', $_GET['content']);
        $url = 'admin.php?page=' . $_REQUEST['page'];
        wp_redirect($url);
    }

    public function exportAction()
    {
        $kid = $_GET['id'];

        $model = new Admin_Model_Vote();
        $model->VoteExportToExcel($kid);
    }

    public function voteAction()
    {
        $model = new Admin_Model_Vote();
        $model->resetVoteToZero();

        ToBack();
    }

    public function lishiAction()
    {
        update_option('_vote_total_lishi', 0);
        update_option('_vote_total_lishi_fail', 0);

        ToBack();
    }

    public function jianshiAction()
    {
        update_option('_vote_total_jianshi', 0);
        update_option('_vote_total_jianshi_fail', 0);

        ToBack();
    }
}