<?php
/* ================================================
  VOTE ALL FUNCTION
  =================================================== */

function VoteTotalLishi()
{
    $tt =  get_option('_vote_total_lishi');
    update_option('_vote_total_lishi', $tt + 1);
    /* return get_option('_vote_total_lishi'); */
}

function VoteTotalLishifail()
{
    $tt = get_option('_vote_total_lishi_fail');
    update_option('_vote_total_lishi_fail', $tt + 1);
    /* return get_option('_vote_total_lishi'); */
}

function VoteTotalJianshi()
{
    $tt = get_option('_vote_total_jianshi');
    update_option('_vote_total_jianshi', $tt + 1);
    /* return get_option('_vote_total_jianshi'); */
}

function VoteTotalJianshifail()
{
    $tt = get_option('_vote_total_jianshi_fail');
    update_option('_vote_total_jianshi_fail', $tt + 1);
    /*  return get_option('_vote_total_lishi'); */
}

function voteTotal($kid)
{
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT  sum(vote_total) as 'total' FROM $table WHERE `kind` = $kid";
    $row = $wpdb->get_row($sql, ARRAY_A);
    return $row;
}

function getVoteResult($kid)
{
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `kind` = $kid AND `status` = 1 ORDER BY `agree` DESC";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function getVoteFinalResult()
{
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `position` != '0' AND `status` = 1 ORDER BY `position`, `is_order` ASC";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function getVoteOrder($kid)
{
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `kind` = $kid AND `status` = 1 ORDER BY `vote_total` DESC";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function getVoteListByKid($kid)
{
    global $wpdb;
    $table = $wpdb->prefix . 'vote';
    $sql = "SELECT * FROM $table WHERE `kind` = $kid AND `status` = 1";
    $row = $wpdb->get_results($sql, ARRAY_A);
    return $row;
}

function updateVoteCount($id)
{
    global $wpdb;
    /* PLUS VOTE COUNT */
    $table = $wpdb->prefix . 'vote';
    $updateSql = "UPDATE $table SET agree=agree + 1 WHERE ID=$id";
    $wpdb->query($updateSql);
}

function userVoteSuccess()
{
    global $wpdb;
    /* SET USER VOTED */
    $table = $wpdb->prefix . 'guests';
    $updateSql = "UPDATE $table SET vote = 1 WHERE ID = " . $_SESSION['voteLogin']['ID'];

    $wpdb->query($updateSql);

    unset($_SESSION['voteLogin']);
}

function kid_name($id)
{
    /* $arr = array('1' => '理事', '2' => '監事'); */
    if ($id == 1) {
        $val = "總會長";
    } elseif ($id == 2) {
        $val = '監事長';
    }
    return $val;
}


function voteLogin($user, $pass)
{
    global $wpdb;
    $table = $wpdb->prefix . 'guests';
    $sql = "SELECT ID, full_name, barcode, serial FROM $table WHERE `full_name` = '$user' AND `barcode` = '$pass' AND `status` = 1 AND `vote` = 0";
    $row = $wpdb->get_row($sql, ARRAY_A);

    if (!empty($row)) {
        $_SESSION['voteLogin'] = $row;
        wp_redirect(home_url('vote'));
    } else {
        return "登入失敗-請檢查帳號或密碼";
    }
}