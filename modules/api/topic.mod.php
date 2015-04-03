<?php
if (! defined ( 'IN_JISHIGOU' )) {
	exit ( 'invalid request' );
}
class ModuleObject extends MasterObject {
	function ModuleObject($config) {
		$this->MasterObject ( $config );
		$this->Execute ();
	}
	function Execute() {
		switch ($this->Code) {
			case 'do_add' :
			case 'add' :
				{
					$this->DoAdd ();
					break;
				}
			case 'delete' :
			case 'del' :
				{
					$this->Delete ();
					break;
				}
			case 'edit' :
			case 'compile' :
			case 'modify' :
				{
					$this->DoModify ();
					break;
				}
			case 'view' :
			case 'show' :
				{
					$this->Show ();
					break;
				}
			case 'list' :
				{
					$this->DoList ();
					break;
				}
			case 'comment' :
				{
					$this->Comment ();
					break;
				}
			case 'favorite' :
				{
					$this->Favorite ();
					break;
				}
			case 'dig' :
				{
					$this->dig ();
					break;
				}
			case 'undig' :
				{
					$this->undig ();
					break;
				}
			case 'isdig' :
				{
					$this->isdig ();
					break;
				}
			case 'mydig' :
				{
					$this->mydig ();
					break;
				}
			case 'digme' :
				{
					$this->digme ();
					break;
				}
			case 'group' :
				{
					$this->grouptopic ();
					break;
				}
			default :
				{
					$this->Main ();
					break;
				}
		}
	}
	function Main() {
		api_output ( 'topic api is ok' );
	}
	function DoAdd() {
		$content = trim ( $this->Inputs ['content'] );
		if (! $content) {
			api_error ( 'content is empty', 104 );
		}
		$totid = max ( 0, ( int ) $this->Inputs ['totid'] );
		$from = "api";
		$item = $this->Inputs ['item'];
		$item_id = 0;
		if ($item && in_array ( $item, array (
				'qun',
				'channel',
				'company' 
		) )) {
			$item_id = max ( 0, ( int ) $this->Inputs ['item_id'] );
			jfunc ( 'app' );
			if (false == (app_check ( $item, $item_id ))) {
				$item_id = 0;
			}
			if ($item == 'channel') {
				$can_pub_topic = jlogic ( 'channel' )->can_pub_topic ( $item_id );
				if (! $can_pub_topic) {
					$item = '';
					$item_id = 0;
				}
			}
		}
		if ('company' == $item) {
			$item_id = $GLOBALS ['_J'] ['member'] ['companyid'];
		}
		if ($item_id < 1) {
			$item = '';
		}
		$type = 'first';
		$_type = 'company' == $item ? 'company' : trim ( strtolower ( $this->Inputs ['type'] ) );
		if ($item_id > 0 && in_array ( $_type, array (
				'qun',
				'company' 
		) )) {
			$type = $_type;
		} elseif ($totid > 0 && in_array ( $_type, array (
				'both',
				'forward' 
		) )) {
			$type = $_type;
		} elseif (in_array ( $_type, array (
				'reply' 
		) )) {
			$type = 'reply';
		} else {
			$type = 'first';
		}
		$imageid = "";
		$p = array ();
		if ($_FILES ['pic']) {
			$p ['pic_field'] = 'pic';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic1']) {
			$p ['pic_field'] = 'pic1';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic2']) {
			$p ['pic_field'] = 'pic2';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic3']) {
			$p ['pic_field'] = 'pic3';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic4']) {
			$p ['pic_field'] = 'pic4';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic5']) {
			$p ['pic_field'] = 'pic5';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic6']) {
			$p ['pic_field'] = 'pic6';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic7']) {
			$p ['pic_field'] = 'pic7';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		if ($_FILES ['pic8']) {
			$p ['pic_field'] = 'pic8';
			$rets = jlogic ( 'image' )->upload ( $p );
			if (! $rets ['error']) {
				$imageid = $imageid . ",";
				$imageid = $imageid . max ( 0, ( int ) $rets ['id'] );
			}
		}
		
		$datas = array (
				'content' => $content,
				'totid' => $totid,
				'from' => $from,
				'type' => $type,
				'uid' => MEMBER_ID,
				'item' => ($item ? $item : 'api'),
				'item_id' => ($item_id > 0 ? $item_id : $this->app ['id']),
				'imageid' => $imageid,
				'anonymous' => ($this->Inputs ['anonymous'] ? 1 : 0) 
		);
		$add_result = $this->TopicLogic->Add ( $datas );
		if (is_array ( $add_result ) && count ( $add_result )) {
			api_output ( $this->_topic ( $add_result ['tid'] ) );
		} else {
			api_error ( ($add_result ? $add_result : '【通知】内容发布失败'), 105 );
		}
	}
	function Delete() {
		$id = max ( 0, ( int ) $this->Inputs ['id'] );
		if (! $id) {
			api_error ( 'id is empty', 102 );
		}
		$topic = $this->_topic ( $id );
		if (! $topic) {
			api_error ( 'id is invalid', 103 );
		}
		if (! ($topic ['uid'] == $this->user ['uid'] || 'admin' == $this->user ['role_type'])) {
			api_error ( 'id is invalid', 103 );
		}
		$return = $this->TopicLogic->DeleteToBox ( $id );
		if ($return) {
			api_error ( $return, 106 );
		}
		api_output ( 'delete is ok' );
	}
	function DoModify() {
		$id = max ( 0, ( int ) $this->Inputs ['id'] );
		if (! $id) {
			api_error ( 'id is empty', 102 );
		}
		$content = trim ( strip_tags ( $this->Inputs ['content'] ) );
		if (! $content) {
			api_error ( 'content is empty', 104 );
		}
		$topic = $this->_topic ( $id );
		if (! $topic) {
			api_error ( 'id is invalid', 103 );
		}
		if ('admin' != $this->user ['role_type']) {
			if ($topic ['uid'] != $this->user ['uid']) {
				api_error ( 'You do not have permission to edit', 115 );
			}
			if ($topic ['replys'] > 0 || $topic ['forwards'] > 0) {
				api_error ( 'Has been comments or forwarding, can\'t edit', 116 );
			}
			if ($this->Config ['topic_modify_time'] && (($topic ['addtime'] ? $topic ['addtime'] : $topic ['dateline']) + ($this->Config ['topic_modify_time'] * 60)) < TIMESTAMP) {
				api_error ( 'Beyond can edit time', 117 );
			}
		}
		$this->TopicLogic->Modify ( $id, $content );
		api_output ( 'modify is ok' );
	}
	function Show() {
		$id = max ( 0, ( int ) $this->Inputs ['id'] );
		if (! $id) {
			api_error ( 'id is empty', 102 );
		}
		$topic = $this->_topic ( $id );
		if (! $topic) {
			api_error ( 'id is invalid', 103 );
		}
		$view_rets = jlogic ( 'topic' )->check_view ( $id );
		if ($view_rets ['error']) {
			api_error ( 'id is invalid', 103 );
		}
		if ($topic ['longtextid'] > 0) {
			$topic = jlogic ( 'longtext' )->get_info ( $topic ['tid'] );
		}
		api_output ( $topic );
	}
	function DoList() {
		$this->_topic_list ();
	}
	function Comment() {
		$id = max ( 0, ( int ) $this->Inputs ['id'] );
		if (! $id) {
			api_error ( 'id is empty', 102 );
		}
		$topic = $this->TopicLogic->Get ( $id );
		if (! $topic) {
			api_error ( 'id is invalid', 103 );
		}
		$return = array ();
		if ($topic ['replys'] > 0) {
			$return = $this->_page ( $topic ['replys'] );
			$p = array (
					'sql_limit' => " {$return['offset']}, {$return['count']} " 
			);
			$p ['sql_order'] = ('dig' == $this->Inputs ['orderby'] ? ' `lastdigtime` DESC ' : ' `dateline` DESC ');
			$tids = jtable ( 'topic_relation' )->get_tids ( $topic ['tid'], $p );
			if ($tids) {
				$sql_where = " where `tid` in (" . jimplode ( $tids ) . ") order by {$p['sql_order']} limit {$return['count']} ";
				$return ['comments'] = $this->_topic ( $sql_where );
			}
		}
		api_output ( $return );
	}
	function Favorite() {
		$id = max ( 0, ( int ) $this->Inputs ['id'] );
		if (! $id) {
			api_error ( 'id is empty', 102 );
		}
		$topic = $this->_topic ( $id );
		if (! $topic) {
			api_error ( 'id is invalid', 103 );
		}
		$act = (in_array ( $this->Inputs ['act'], array (
				'check',
				'add',
				'delete' 
		) ) ? $this->Inputs ['act'] : 'check');
		$ret = jlogic ( 'topic_favorite' )->act ( MEMBER_ID, $id, $act );
		$ret = ('check' == $act ? ($ret ? 1 : 0) : 1);
		api_output ( $ret );
	}
	function isdig() {
		$tid = max ( 0, ( int ) $this->Inputs ['tid'] );
		if (! $tid) {
			api_error ( 'tid is empty', 1001 );
		}
		$topic = $this->_topic ( $tid );
		if (! $topic) {
			api_error ( 'tid is invalid', 1002 );
		}
		$count = DB::result_first ( "SELECT COUNT(*) FROM " . DB::table ( 'topic_dig' ) . " WHERE tid='{$tid}' AND uid = '" . MEMBER_ID . "'" );
		api_output ( array (
				'digcounts' => $topic ['digcounts'],
				'isdig' => $count 
		) );
	}
	function dig() {
		$tid = max ( 0, ( int ) $this->Inputs ['tid'] );
		if (! $tid) {
			api_error ( 'tid is empty', 1001 );
		}
		$topic = $this->_topic ( $tid );
		if (! $topic) {
			api_error ( 'tid is invalid', 1002 );
		}
		$count = DB::result_first ( "SELECT COUNT(*) FROM " . DB::table ( 'topic_dig' ) . " WHERE tid='{$tid}' AND uid = '" . MEMBER_ID . "'" );
		if ($count > 0) {
			api_error ( 'you have diged this topic', 1003 );
		}
		$uid = $topic ['uid'];
		if ($uid == MEMBER_ID) {
			api_error ( 'you do not pemission to dig your topic', 1004 );
		}
		jtable ( 'topic_more' )->update_diguids ( $tid );
		DB::query ( "update `" . DB::table ( 'members' ) . "` set `digcount` = digcount + 1,`dig_new` = dig_new + 1 where `uid`='{$uid}'" );
		$ary = array (
				'tid' => $tid,
				'uid' => MEMBER_ID,
				'touid' => $uid,
				'dateline' => time () 
		);
		DB::insert ( 'topic_dig', $ary, true );
		jtable ( 'topic' )->update_digcounts ( $tid );
		// update_credits_by_action ( 'topic_dig', MEMBER_ID );
		// update_credits_by_action ( 'my_dig', $uid );
		api_output ( array (
			'digcounts' => $topic ['digcounts'],
			'isdig' => "1" 
		) );
	}
	function undig() {
		$tid = max ( 0, ( int ) $this->Inputs ['tid'] );
		if (! $tid) {
			api_error ( 'tid is empty', 1001 );
		}
		$topic = $this->_topic ( $tid );
		if (! $topic) {
			api_error ( 'tid is invalid', 1002 );
		}
		$count = DB::result_first ( "SELECT COUNT(*) FROM " . DB::table ( 'topic_dig' ) . " WHERE tid='{$tid}' AND uid = '" . MEMBER_ID . "'" );
		if (! ($count > 0)) {
			api_error ( 'you have not diged this topic', 1003 );
		}
		$uid = $topic ['uid'];
		if ($uid == MEMBER_ID) {
			api_error ( 'you do not pemission to dig your topic', 1004 );
		}
		jtable ( 'topic_more' )->update_diguids ( $tid, "-1" );
		DB::query ( "update `" . DB::table ( 'members' ) . "` set `digcount` = digcount - 1,`dig_new` = dig_new - 1 where `uid`='{$uid}'" );
		// DB::insert ( 'topic_dig', $ary, true );
		DB::delete ( 'topic_dig', "tid='{$tid}' AND uid = '" . MEMBER_ID . "'" );
		jtable ( 'topic' )->update_digcounts ( $tid, "-1" );
		api_output ( array (
			'digcounts' => $topic ['digcounts'],
			'isdig' => "1" 
		) );
	}
	function mydig() {
		$uid = max ( 0, ( int ) $this->Inputs ['uid'] );
		$uid = $uid ? $uid : MEMBER_ID;
		$sql_wheres = array ();
		$tids = array (
				0 
		);
		$query = DB::query ( "select tid from " . DB::table ( 'topic_dig' ) . " where uid = '$uid' order by `id` desc" );
		while ( $row = DB::fetch ( $query ) ) {
			$tids [$row ['tid']] = $row ['tid'];
		}
		$sql_wheres [] = "`tid` IN(" . jimplode ( $tids ) . ")";
		$this->_topic_list ( 'new', $sql_wheres );
	}
	function digme() {
		$uid = max ( 0, ( int ) ($this->Inputs ['uid'] ? $this->Inputs ['uid'] : $this->user ['uid']) );
		jlogic ( 'member' )->clean_new_remind ( 'dig_new', $uid );
		$tids = array (
				0 
		);
		$query = DB::query ( "select DISTINCT tid from " . DB::table ( 'topic_dig' ) . " where touid = '$uid' order by `id` desc" );
		while ( $row = DB::fetch ( $query ) ) {
			$tids [$row ['tid']] = $row ['tid'];
		}
		$sql_wheres [] = "`tid` IN(" . jimplode ( $tids ) . ")";
		$this->_topic_list ( 'new', $sql_wheres );
	}
	function grouptopic() {
		$uid = max ( 0, ( int ) ($this->Inputs ['uid'] ? $this->Inputs ['uid'] : $this->user ['uid']) );
		$gid = max ( 0, ( int ) $this->Inputs ['gid'] );
		$uids = array (
				0 
		);
		if ($gid) {
			$uids = jtable ( 'buddy_follow_group_relation' )->get_my_group_uids ( $uid, $gid );
			$sql_wheres [] = "`uid` IN(" . jimplode ( $uids ) . ")";
			$this->_topic_list ( 'new', $sql_wheres );
		} else {
			api_error ( 'group id is invalid', 1005 );
		}
	}
}
?>
