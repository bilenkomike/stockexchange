<?php 


class Home extends Controller {
// INDEX
	public function index($page = 1) {


		if (!empty(Input::get('filter'))) {
			$tag_id = $this->_db->first($this->_db->get('tags', array('tag', '=', Input::get('filter'))))->id;
			$worksfiltered = $this->_db->results($this->_db->get('works',array('tags','=', $tag_id)));
			foreach( $worksfiltered as $workfiltered ) {
				$workUser = $this->_db->first($this->_db->get('users', array('id','=', $workfiltered->user_id)));
				$workfiltered->user = [
				'fullname' => $workUser->fullname,
				'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
				'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
				];
				$workfiltered->image = '../app/custmfolders/' . $this->_db->first($this->_db->get('users', array('id', '=', $workfiltered->user_id)))->dir_url . '/' . $workfiltered->image;
				$workfiltered->tags = Input::get('filter');
			}
			$this->message('ok', $worksfiltered);
		}

		$post_items = $this->_db->getsort('posts')->results();
		$posts = array();
		

		foreach ( $post_items as $post ) {
				$tags = array();
				if($post->tags != '0') {
					$post_tags_ids = json_decode($post->tags, true);
					foreach($post_tags_ids as $post_tag_id) {
						$tags[] = $this->_db->first($this->_db->get('tags', array('id', '=', $post_tag_id)))->tag;
					}
				}

				
				$posts[] = ['post' => $post, 'author' => $this->_db->first($this->_db->get('users', array('id', '=', $post->author)))->fullname, 'author_id' =>$this->_db->first($this->_db->get('users', array('id', '=', $post->author)))->id, 'post_tags' => $tags];	
		}

		$tags = $this->_db->results($this->_db->get('tags'));

		$works = $this->_db->get('works')->results();
		foreach( $works as $work ) {
			$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;

			// $work->tag = $this->_db->first($this->_db->get('tags', array('id', '=', $work->tags)))->tag;
			$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;

			$wrk_tgs = array();
			foreach( json_decode($work->tags, true) as $tag_item ) {
				$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
			}
			$work->tag = $wrk_tgs;

			$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
			$work->user = [
				'fullname' => $workUser->fullname,
				'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
				'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
			];
		}

		$page_lim = 4;

		if ( $page == 1 ) {
			$limit1 = 0;
			$limit2 = 4;

		}
		else {
			$limit1 = (int)$page_lim*((int)$page-1);
			$limit2 = $limit1 + $page_lim;
		}

		$users = $this->_db->results($this->_db->get('users'));
		$userss = array();
 		foreach ( $users as $User ) {
 			if ($User->activity == 1 || $User->activity == 2) {
 				$User->prof = $this->_db->first($this->_db->get('proffesions', array('id', '=', $User->prof)))->prof_name;
 				$User->category = $this->_db->first($this->_db->get('categories', array('id', '=', $User->category)))->category_name;
 				$userss[] = $User; 
 			}
 		}


		$this->view('stockexchange/home/index', 
			[	'posts' => $posts,
				'works' => array_slice(array_reverse($works), $limit1, $limit2),
				'filters'=> [
					'tags' => $tags,	
				],
				
				'page_num'=> $page,
				'users' => array_slice($userss,0,4),
				'works_count' => ceil(count($works) / $page_lim),
				'users_url' => 'home/index/',
			]);
	}

	// works
	public function works($page = '1') {
		$db = $this->_db;
		$user = $this->model('User');


		$tags = $this->_db->results($this->_db->get('tags'));

		$catefories = $this->_db->results($this->_db->get('categories'));
		$profs = $this->_db->results($this->_db->get('proffesions'));

		$works = $this->_db->results($this->_db->get('works'));
		foreach( $works as $work ) {
			$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;
			$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
			$wrk_tgs = array();
			foreach( json_decode($work->tags, true) as $tag_item ) {
				$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
			}
			$work->tag = $wrk_tgs;


			
			$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
			$work->user = [
				'fullname' => $workUser->fullname,
				'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
				'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
			];
		}

		$page_lim = 4;

		if ( $page == 1 ) {
			$limit1 = 0;
			$limit2 = 4;
		}
		else {
			$limit1 = (int)$page_lim*((int)$page-1);
			$limit2 = $limit1 + $page_lim;
		}

		$this->view('stockexchange/home/works', 
			[	'works' => array_slice(array_reverse($works), $limit1, $limit2),
				'user' => $user,
				'filters'=> [
					'categories' => $catefories,
				],
				
				'page_num'=> $page,
				'works_count' => ceil(count($works) / $page_lim),
				'users_url' => 'home/works/',
			]);
	}

	public function work ($work_id) {
		$user = $this->model('User')->data();
		$work = $this->_db->first($this->_db->get('works', array('id','=',$work_id)));
		
		$this->_db->update('works', $work_id, array('views' => $work->views + 1));

		if ( $work->user_id == $user->id ) {
			$work->user = $user;
		}
		else {
			$work->user = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)));
		}

		$work->interesting = array();
		$sortworksbyviews = $this->_db->results($this->_db->getsort('works', array(), "DESC","views", array(0,2)));

		$sortworksbydownloads = $this->_db->results($this->_db->getsort('works', array(), "DESC","downloads_linked", array(0,2)));

		foreach($sortworksbyviews as $sort) {
			$work->interesting[] = array(
				'id' => $sort->id,
				'title' => $sort->title,
				'date' => $sort->date,
				'views' => $sort->views
			);
		}
		foreach($sortworksbydownloads as $sort) {
			$work->interesting[] = array(
				'id' => $sort->id,
				'title' => $sort->title,
				'date' => $sort->date,
				'views' => $sort->downloads_linked
			);
		}



		$work->liked = json_decode($work->liked, true)[$user->id];


		$author = $this->_db->first($this->_db->get('users', array('id','=',$work->user_id)));
		$author->category = $this->_db->first($this->_db->get('categories', array('id','=',$author->category)))->category_name;
		$work->author = $author;
		$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;

		$wrk_tgs = array();
			foreach( json_decode($work->tags, true) as $tag_item ) {
				$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
			}
		$work->tags = $wrk_tgs;


		$this->view('stockexchange/home/work', ['work' => $work, 'logged' => $this->model('User')->isLoggedIn()]);
	}
	
// ABOUT
	public function about() {

		$post = $this->_db->get('languages');

		$this->view('stockexchange/home/about', ['lang'=> $lang]);
	}

// USERS

 	public function users() {

 		$users = $this->_db->results($this->_db->get('users'));
 		$tags = $this->_db->results($this->_db->get('tags'));
 		foreach ( $users as $user ) {
 			$user->prof = $this->_db->first($this->_db->get('proffesions', array('id', '=', $user->prof)))->prof_name;
 			$user->category = $this->_db->first($this->_db->get('categories', array('id', '=', $user->category)))->category_name;
 		}

 		$catefories = $this->_db->results($this->_db->get('categories'));
		$profs = $this->_db->results($this->_db->get('proffesions'));

 		$this->view('stockexchange/home/users', 
 			[
 				'users' => $users,
				'filters'=> [
					'categories' => $catefories,
					'professions' => $profs
				],

 			]);
 	}
// PERSON
 	public function person($id, $page = '1') {
 		$user = $this->model('User')->data();
 		$friend = false;
 		$cv = false;
 		if($this->model('User')->isLoggedIn()) {
 			$friends = json_decode($user->friends, true);


	 		foreach($friends as $friend) {
	 			if( $friend == $id ) {
	 				$friend = true;
	 			}
	 		}
 		}
 		
 		$requests = $this->_db->results($this->_db->get('requests'));

 		foreach( $requests as $request ) {
 			if( ($request->from_user == $id && $request->to_user == $user->id ) || ($request->from_user == $user->id && $request->to_user == $id ) ) {
 				$progress = true;
 			}
 		}
 		
 		

		$post_items = $this->_db->results($this->_db->getsort('posts', array('author','=', $id)));
		$posts = array();
		



		foreach ( $post_items as $post ) {
				$tags = array();
				if($post->tags != '0') {
					$post_tags_ids = json_decode($post->tags, true);
					foreach($post_tags_ids as $post_tag_id) {
						$tags[] = $this->_db->first($this->_db->get('tags', array('id', '=', $post_tag_id)))->tag;
					}
				}

				
				$posts[] = ['post' => $post, 'author' => $this->_db->first($this->_db->get('users', array('id', '=', $post->author)))->fullname, 'author_id' =>$this->_db->first($this->_db->get('users', array('id', '=', $post->author)))->id, 'post_tags' => $tags];	
		}

		$tags = $this->_db->results($this->_db->get('tags'));

		$works = $this->_db->results($this->_db->get('works', array('user_id','=', $id)));
		foreach( $works as $work ) {
			$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
			$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;

			$wrk_tgs = array();
			foreach( json_decode($work->tags, true) as $tag_item ) {
				$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
			}
			$work->tag = $wrk_tgs;
			

			$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
			$work->user = [
				'fullname' => $workUser->fullname,
				'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
				'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
			];
		}

		$page_lim = 4;

		if ( $page == 1 ) {
			$limit1 = 0;
			$limit2 = 4;

		}
		else {
			$limit1 = $page_lim*($page-1);
			$limit2 = $limit1 + $page_lim;
		}

		$update = false;
 		if ( $user->id == $id ) {
 			$update = true;
 		}

 		$rec_user = $this->_db->first($this->_db->get('users', array('id','=', $id)));
 		$rec_user->category = $this->_db->first($this->_db->get('categories', array('id', '=', $rec_user->category)))->category_name;

 		$cv = false;
 		if( count($this->_db->get('cv', array('hash', '=', $rec_user->dir_url))->results()) > 0 ) {
 			$cv = true;
 		}



		$this->view('stockexchange/home/person', 

			[	'friends' => $friends,
				'friend' => $friend,
				'id' => $user->id,
				'posts' => $posts,
				'works' => array_slice(array_reverse($works), $limit1, $limit2),
				'limit1' => $limit1,
				'limit2' => $limit2,
				'user' => $user,
				'filters'=> [
					'tags' => $tags,	
				],
				'logged' => $this->model('User')->isLoggedIn(),
				'page_num'=> $page,
				'works_count' => ceil(count($works) / $page_lim),
				'users_url' => 'home/person/'.$id.'/',
				'user' => $rec_user,
 				'update' => $update,
 				'progress' => $progress,
 				'cv' => $cv
			]);

 	}

// LOGIN
	public function login() {
		if($this->model('User')->isLoggedIn()) {
			Redirect::to('home/index/');
		}
		$form = $this->form('stockexchange', 'login');
		$errors = [];
		$success = '';
		if(Input::exists()) {
			if(Token::check(Input::get('token'))) {
				$validate = $this->model('Validate');
				$validation = $validate->check($_POST, array(
					'email' => array(
						'required' => true
					),
					'password' => array(
						'required' => true
					)
				));
				if($validation->passed()) {
					$user = $this->model('User');
					
					$remember = (Input::get('remember') === 'on') ? true : false;
					
					$login = $user->login(Input::get('email'), Input::get('password'), $remember);

					if($login) {
						$this->_db->update('users', $user->data()->id, array('activity' => '1'));
						$id = Session::get('user_login_id');
						Session::delete('user_login_id');
						Redirect::to('home/person/'.$id.'/');
					}
					else {
						$success = 'No success';

					}
				}
				else {
					foreach($validation->errors() as $error) {
						$errors[] = $error;
					}
				}
			}
		}

		$this->view('stockexchange/home/login', 
			[
				'form'=>$form,
				'errors' => $errors,
				'success' => $success
			]
		);
	}


// REGISTER
	public function register() {
		if($this->model('User')->isLoggedIn()) {
			Redirect::to('home/index/');
		}
		$form = $this->form('stockexchange', 'register');
		$errors = array();
		if(Input::exists()) {
			if(Token::check(Input::get('token'))) {
				$validate = $this->model('Validate');
				$validation = $validate->check($_POST, array(
					'fullname' => array(
						'required' => true,
						'min' => 2,
						'max' => 40,
					),
					'username' => array(
						'required' => true,
						'min' => 2,
						'max' => 25,
						'unique' => 'users'
					),
					'email' => array(
						'required' => true,
						'min' => 10,
						'max' => 49,
						'unique' => 'users'
					),
					'confirm__email' => array(
						'required' => true,
						'unique' => 'users'
					),
					'password' => array(
						'required' => true,
						'min' => 6
					),
					'password__again' => array(
						'required' => true,
						'matches' => 'password'
					)
				));
				if($validation->passed()) {
					$user = $this->model('User');
					$salt = Hash::salt(16);
					
					try {
						$dir_hash = Hash::salt(16);
						mkdir('../app/custmfolders/'.$dir_hash);
						mkdir('../app/custmfolders/'.$dir_hash.'/images');
						mkdir('../app/custmfolders/'.$dir_hash.'/images/avatars');
						mkdir('../app/custmfolders/'.$dir_hash.'/images/contents');
						mkdir('../app/custmfolders/'.$dir_hash.'/configs');
						mkdir('../app/custmfolders/'.$dir_hash.'/docs');
						mkdir('../app/custmfolders/'.$dir_hash.'/works');
						mkdir('../app/custmfolders/'.$dir_hash.'/works/images');
						mkdir('../app/custmfolders/'.$dir_hash.'/zips');
						

						$user->create(array(
							'username' => Input::get('username'),
							'password' => Hash::make(Input::get('password'), $salt),
							'salt' => $salt,
							'email' => Input::get('email'),
							'confirm__email' => Input::get('confirm__email'),
							'joined' => date('Y-m-d H:i:s'),
							'group' => 1,
							'ava' => 'images/avatars/avatar.png',
							'dir_url' => $dir_hash,
							'about_user' => ' ',
							'fullname' => Input::get('fullname'),
							'prof' => NULL,
							'category' => NULL,
							'friends' => '{}',
							'lastOnline' => date('Y-m-d H:i:s'),
							'activity' => 1,
							'preview__image' => 0,
							'facebook' => '',
							'instagram' => '',
							'gitHub' => '',
							'linkedin' => '',

						));
						$id = $this->_db->first($this->_db->get('users', array('salt','=',$salt)))->id;
						$remember = false;
						$login = $user->login(Input::get('email'), Input::get('password'), $remember);

						// mkdir('../app/custmfolders/stash/'.$id);

                        copy('images/icons/user.png', '../app/custmfolders/'.$dir_hash.'/images/avatars/avatar.png');




						
						$id = Session::get('user_login_id');
						Session::delete('user_login_id');
						Redirect::to('home/person/'.$id.'/');
					}
					catch(Exception $e) {
						die($e->getMessage());
					}
				}
				else {
					foreach($validation->errors() as $error) {
						$errors[] = $error; 
					}
				}
			}
		}


		$this->view('stockexchange/home/register', 
			['form'=>$form, 'errors' => $errors]);
	}

// MESSENGER
	public function messanger() {
		$this->isLogged();
		$user = $this->model('User');

		$mess = $this->_db->results($this->_db->get('messages'));
		$chat_hashes = $this->_db->results($this->_db->get('chat_hash'));
		if(!empty(Input::get('hash'))) {
			foreach( $chat_hashes as $hash ) {
				if ($hash->hash == Input::get('hash') ) {
					if ( $hash->user_from == $user->data()->id ) {
						$chat_user = $this->_db->first($this->_db->get('users', array('id','=',$hash->user_to)));
					}	
					else if( $hash->user_to == $user->data()->id) {
						$chat_user = $this->_db->first($this->_db->get('users', array('id','=',$hash->user_from)));
					}
				}
			}
			$messages = $this->_db->results($this->_db->get('messages', array('hash', '=', Input::get('hash'))));
			foreach( $messages as $message ) {
				if ( $message->user_from == $user->data()->id ) {
					$self = true;
					$user_data = [
						'username' => $user->data()->username,
						'ava' => '../app/custmfolders/' . $user->data()->dir_url . '/' .$user->data()->ava,
						'status' => $user->data()->status, 
						'lastOnline' => $user->data()->lastOnline
					];
					
				}
				else {
					$self = false;
					$user_data = [
						'username' => $this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->username,
						'ava' => '../app/custmfolders/' . $this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->dir_url . '/' . $this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->ava,
						'status' => $this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->status, 
						'lastOnline' => $this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->lastOnline
					];
				}

				$chatListsList[] = ['user' => $user_data, 'self' => $self, 'message' => $message ];
			}

			if ( !empty(Input::get('dragdata')) ) {
				$this->message('ok', Input::get('dragdata'));
			}
			
			$this->messageMessanger(Input::get('hash'),$chatListsList,$chat_user);
		}


		if ( !empty(Input::get('clearMessageHistory')) ) {
			$this->_db->delete('messages', array('hash', '=',Input::get('clearMessageHistory')));
			$this->message('ok', Input::get('clearMessageHistory'));
		}



		if ( !empty(Input::get('chat_id')) ) {
			$chater = $this->_db->first($this->_db->get('chat_hash', array('hash', '=', Input::get('chat_id'))));
			if($chater->user_from == $user->data()->id) {
				$chater = $chater->user_to;
			}
			else {
				$chater = $chater->user_to;
			}


			
			$type = "0";
			if(!empty(Input::get('message__image'))) {
				$type = "1";
			}

			

			$insert__array = array(
				'type' => $type,
				'user_from' => $user->data()->id,
				'time' => date('Y-m-d H:i:s'),
				'message' => Input::get('message'),
				'hash' => Input::get('chat_id'),
				'user_to' => $chater,
				'gruop' => "0",	
				'viewed' => 0,
				'image' => Input::get('message__image')
			);
			$this->_db->insert('messages', $insert__array);

			$this->message('ok', ['chat_id' => Input::get('chat_id'), 'message' => $insert__array, 'user' => array('username' => $user->data()->username, 'ava' => '../app/custmfolders/' . $user->data()->dir_url . '/' . $user->data()->ava ) ]);
		}


		if (!empty(Input::get('chat__url'))) {
			$messages = $this->_db->results($this->_db->get('messages', array('viewed','=', 0)));
			// $this->newMessage(Input::get('chat__url'));
			$return__messages = array();
			foreach( $messages as $message ) {
				if($message->hash == Input::get('chat__url') && $message->user_from != $user->data()->id) {
					$self = false;
					$user_from = ['username' => $this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->username,
						'ava' => '../app/custmfolders/'.$this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->dir_url.'/'.$this->_db->first($this->_db->get('users', array('id', '=', $message->user_from)))->ava];
					$return__messages[] = ['message' => $message, 'self' => $self, 'user'=> $user_from];
					$this->_db->update('messages', $message->id, array('viewed'=>1));
				}
			}
			$this->message(Input::get('chat__url'), $return__messages);

			// $this->newMessage($return__messages);
		}

		$messanger__hashes = $this->_db->results($this->_db->get('chat_hash'));
		foreach($messanger__hashes as $messanger__hashe) {
			if($messanger__hashe->user_from == $user->data()->id || $messanger__hashe->user_to == $user->data()->id) {
				$last_message = $this->_db->first($this->_db->getLastRecord('messages', array('hash', '=', $messanger__hashe->hash), '*'));
				if($user->data()->id == $messanger__hashe->user_from) {
					$uSer = $this->_db->first($this->_db->get('users', array('id', '=', $messanger__hashe->user_to)));
				}
				else {
					$uSer = $this->_db->first($this->_db->get('users', array('id', '=', $messanger__hashe->user_from)));	
				} 
				$chats[] = ['hash'=>$messanger__hashe, 'last_record'=>$last_message, 'user' => [
					'id' => $uSer->id, 
					'fullname' => $uSer->username,
					'activity' => $uSer->activity,
					'ava' => '../app/custmfolders/' . $uSer->dir_url . '/' . $uSer->ava
				]];

			}
		

		}

		if(!empty(Input::get('messanger__searh'))) {
			$messanger__hashes = array();
			if( Input::get('messanger__searh') != 'all' ) {
				$users_like = array();
				$friends = json_decode($user->data()->friends, true);
				$users = array();
				$users = $this->_db->results($this->_db->getlike('users', array('username'), Input::get('messanger__searh')));
				$hahses = $this->_db->results($this->_db->get('chat_hash'));

				foreach ( $users as $uSer ) {
					foreach( $hahses as $hash ) {
						if ( ($hash->user_from == $user->data()->id && $hash->user_to == $uSer->id) || ($hash->user_to == $user->data()->id && $hash->user_from == $uSer->id) ) {
							$messanger__hashes[] = $hash;
						}
					}
				}
			}
			else {

				$messanger__hashes = $this->_db->results($this->_db->get('chat_hash'));
				
			}
			$chats = array();

			foreach($messanger__hashes as $messanger__hashe) {
				if($messanger__hashe->user_from == $user->data()->id || $messanger__hashe->user_to == $user->data()->id) {
					$last_message = $this->_db->first($this->_db->getLastRecord('messages', array('hash', '=', $messanger__hashe->hash), '*'));
					if($user->data()->id == $messanger__hashe->user_from) {
						$uSer = $this->_db->first($this->_db->get('users', array('id', '=', $messanger__hashe->user_to)));
					}
					else {
						$uSer = $this->_db->first($this->_db->get('users', array('id', '=', $messanger__hashe->user_from)));	
					} 
					$chats[] = ['hash'=>$messanger__hashe, 'last_record'=>$last_message, 'user' => [
						'id' => $uSer->id, 
						'fullname' => $uSer->username,
						'activity' => $uSer->activity,
						'ava' => '../app/custmfolders/' . $uSer->dir_url . '/' . $uSer->ava
					]];

				}
				

			}


			$this->message(Input::get('messanger__searh'),array_reverse($chats));

		}

		

		if(!empty( $_FILES['imageloadforpost'] )) {




		$file__dir = '../app/custmfolders/' . $user->data()->dir_url . '/images/contents/';


			$image = $_FILES['imageloadforpost'];
			

			$times = array(date('Y'), date('m'), date('d'));

			foreach ( $times as $time ) {

				if ( !is_dir($file__dir.$time) ) {

					mkdir($file__dir.$time);
					$file__dir = $file__dir.$time.DIRECTORY_SEPARATOR;

				}
				else {
					$file__dir = $file__dir.$time.DIRECTORY_SEPARATOR;
					continue;
				}
			}
			


			// $images__info = array();
			// $file__image__paths = array();
			$host = $_SERVER['HTTP_ORIGIN'];
			
			
			$image_name = $image['name'];
			$tmp_name = $image['tmp_name'];
			if (file_exists($file__dir.$image_name)) {
				$host = $_SERVER['HTTP_ORIGIN'];
				$file__image__path = str_replace('..', $host, $file__dir) . $image_name;
				$this->imgsrc($file__image__path, Input::get('width'), Input::get('height'));
			}
			move_uploaded_file($tmp_name, $file__dir.$image_name);
			

			$file__image__path = str_replace('..', $host, $file__dir) . $image_name;


			$path = $file__image__path;
			







			// $file = $_FILES['imageloadforpost'];
			// $path = "../app/custmfolders/{$user->data()->dir_url}/images/contents";

			// if( !file_exists($path.$user->data()->id) ) {
			// 	mkdir($path.$user->data()->id);
			// }
			// $path = $path.$user->data()->id.'/';
			// move_uploaded_file($file['tmp_name'], $path.$file['name']);
			// $path = $path.$file['name'];


			$this->imgsrc($path, Input::get('width'), Input::get('height'));
		
		}

		if(!empty($chats)) {
			$chats = array_reverse($chats);
		}

		$this->view('stockexchange/home/messenger', ['user'=>$user, 'chats' => $chats]);
	}


// POST
	public function post($post_id = '') {
		$user = $this->model('User');
		


		$Com = '';
		if(!empty(Input::get('comment__text'))) {
			if(!empty(Input::get('PostId_commentId'))) {
				// REANSWER comment

				$check = explode('-', Input::get('PostId_commentId'));
				$commId = $check[1];
				$postId = $check[0];
				$Com = json_decode($this->_db->first($this->_db->get('posts', array('id', '=', $postId)))->comments, true)[$commId]['reanswers'];
				$ans = [
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $user->data()->id,
					'comment_text' => Input::get('comment__text')
				];
				$Com[count($Com) + 1] = $ans;
				
				$com = json_decode($this->_db->first($this->_db->get('posts', array('id', '=', $postId)))->comments, true);
				$com[$commId]['reanswers'] = $Com;
				$com = json_encode($com);
				$this->_db->update('posts', $postId, array('comments' => $com));
				unset($_POST['comment__text']);
			}
			else {

				// comment !! NOT REANSWER


				$Com1 =  json_decode($this->_db->first($this->_db->get('posts', array('id', '=', $post_id)))->comments, true);
				$comment = [
					'comment_date' => date('Y-m-d H:i:s'),
					'user_id' => $user->data()->id,
					'comment_text' => Input::get('comment__text'),
					'reanswers' => []
				];
				$Com1[count($Com1) + 1] = $comment;
				$Com1 = json_encode($Com1);
				$this->_db->update('posts', $post_id, array('comments' => $Com1));
				unset($_POST['comment__text']);

			}
		}

		
		$post_comments = array();
		if(!empty($post_id)) {
			$post = $this->_db->first($this->_db->get('posts', array('id', '=', $post_id)));
			$this->_db->update('posts', $post_id, array('views' => $post->views + 1));
				$Post = $post;
				foreach(json_decode($post->tags, true) as $tag) {
					$post_tags[] = $this->_db->first($this->_db->get('tags', array('id', '=', $tag)))->tag;
				}
				
				$post_comment_items = json_decode($post->comments, true);
				if($post_comment_items != ''){
					foreach($post_comment_items as $comment_key => $post_comment_item) {
						$comment_user = array(
							'fullname' => $this->_db->first($this->_db->get('users', array('id', '=', $post_comment_item['user_id'])))->fullname,
							'ava_path' => '../app/custmfolders/' . $this->_db->first($this->_db->get('users', array('id', '=', $post_comment_item['user_id'])))->dir_url . '/' . $this->_db->first($this->_db->get('users', array('id', '=', $post_comment_item['user_id'])))->ava,
						);
						$reanswers = array();
						if($post_comment_item['reanswers'] != '{}') {
							foreach($post_comment_item['reanswers'] as $reanswer ) {
								$reanswers[] = array(
									'reanswer_user' => array(
										'fullname' => $this->_db->first($this->_db->get('users', array('id', '=', $reanswer['user_id'])))->fullname,
										'ava_path' => '../app/custmfolders/' . $this->_db->first($this->_db->get('users', array('id', '=', $reanswer['user_id'])))->dir_url . '/' . $this->_db->first($this->_db->get('users', array('id', '=', $reanswer['user_id'])))->ava,
									),
									'reanswer_comment' => $reanswer['comment_text'],
									'reanswer_date' => $reanswer['date']
								);
							}
						}
						$post_comments[] = [
							'comment_id' => $comment_key,
							'user'=> $comment_user,
							'comment' => $post_comment_item['comment_text'],
							'reanswers' => $reanswers,
							'comment_date' => $post_comment_item['comment_date']
						]; 
					}
				}
				else {
					$post_comments = [];
				}
			
		}

		$author = $this->_db->first($this->_db->get('users', array('id','=',$Post->author)));
		$author->category = $this->_db->first($this->_db->get('categories', array('id','=',$author->category)))->category_name;
		$Post->author = $author;
		$sortpostsbyviews = $this->_db->results($this->_db->getsort('posts', array(), "DESC","views", array(0,4)));

		foreach($sortpostsbyviews as $sort) {
			$Post->interesting[] = array(
				'id' => $sort->id,
				'title' => $sort->title,
				'date' => $sort->date,
				'views' => $sort->views
			);
		}

		$this->view('stockexchange/home/post', [
				'post_id' => $post_id,
				'logged' => $user->isLoggedIn(),
				'user' => $user->data(),
				'post' => $Post,
				'post_tags' => array_reverse($post_tags), 
				'post_comments' => array_reverse($post_comments),
			]
		);
	}





// ADMINPAGE
	public function admin() {
		$this->isLogged();
		



		$user = $this->model('User');

		
		

		$db = $this->_db;
		$errors = array();

		if(!empty(Input::get('removePost')) ) {
			$this->_db->delete('posts', array('id','=',Input::get('removePost')));
			$this->message('ok', Input::get('removePost'));
		}

		if(!empty(Input::get('editpost')) ) {
			$post = $this->_db->first($this->_db->get('posts', array('id', '=', Input::get('editpost'))));
			$tags = array();
			foreach ( json_decode($post->tags, true) as $tg ) {
				$tags[] = $this->_db->first($this->_db->get('tags', array('id','=',$tg)))->tag;
			}
			$post->tags = $tags;



			$this->message('ok', $post);
		}

		if(!empty($_FILES['imageloadforpost'])) {
			$image = $_FILES['imageloadforpost'];
			$imgpath = $image['tmp_name'];
			$imgname = explode('.', $image['name'])[count(explode('.', $image['name'])) -1];
			$imagagepath = '../app/custmfolders/' . $user->data()->dir_url . '/works/images/'.date('H').date('i').date('s').'.'.$imgname;
			move_uploaded_file($imgpath, $imagagepath);
			$this->imgsrc($imagagepath, Input::get('width'), Input::get('height'));
		}
		if(!empty($_FILES['Simageloadforpost'])) {
			$image = $_FILES['Simageloadforpost'];
			$imgpath = $image['tmp_name'];
			$imgname = explode('.', $image['name'])[count(explode('.', $image['name'])) -1];

			$folds = array($user->data()->id, date('Y'), date('m'), date('d'), date('H')); 
			$path = '../app/custmfolders/posts/';
			foreach ( $folds as $fold ) { 
				
				if(!file_exists($path.$fold)) {
					mkdir($path.$fold);
				}
				$path = $path.$fold.'/';
			}

			$imagagepath = $path.date('H').date('i').date('s').'.'.$imgname;
			move_uploaded_file($imgpath, $imagagepath);
			// $this->message('ok',$path);
			$this->imgsrc($imagagepath, Input::get('Swidth'), Input::get('Sheight'));
		}
		
		// profile/update your profile
		if(!empty($_POST['username'])) {
			if(Input::exists()) { 
				if(Token::check(Input::get('token'))) {
					$validate = $this->model('Validate');
					$validation = $validate->check($_POST, array(
						'username' => array(
							'required' => true,
							'min' => 2,
							'max' => 25
						),
						'fullname' => array(
							'required' => true,
						),
						'email' => array(
							'required' => true
						),
						'prof' => array(
							'required' => true
						),
					));
					if($validation->passed()){
						try {
							$this->_db->update('users', $user->data()->id, ['username'=>Input::get('username'),
								'facebook' => Input::get('facebook'),
								'instagram'=> Input::get('instagram'),
								'gitHub'=> Input::get('gitHub'),
								'linkedin'=> Input::get('linkedin'),
								'about_user' => Input::get('about__user')
							]);
							$this->_db->update('users', $user->data()->id, ['username'=>Input::get('username')]);
							$this->_db->update('users', $user->data()->id, ['fullname'=>Input::get('fullname')]);
							$this->_db->update('users', $user->data()->id, ['email'=>Input::get('email')]);
							$this->_db->update('users', $user->data()->id, ['prof'=>$this->_db->first($this->_db->get('proffesions', array('prof_name','=',Input::get('prof'))))->id]);
							$this->_db->update('users', $user->data()->id, ['category'=>$this->_db->first($this->_db->get('categories', array('category_name','=',Input::get('category'))))->id]);
							
							if(!empty($_FILES['avatar']) && $_FILES['avatar']['error'] != 4) {
								$avatar = $_FILES['avatar'];
								$tmp_name = $avatar['tmp_name'];
								move_uploaded_file($tmp_name, "../app/custmfolders/{$user->data()->dir_url}/images/avatars/avatar.jpg");
								$this->_db->update('users', $user->data()->id, ['ava' => 'images/avatars/avatar.jpg']);
							}
							
							if(!empty($_FILES['preview__image']) && $_FILES['preview__image']['error'] != 4) {
							
								if( file_exists('../app/custmfolders/'.$user->data()->dir_url.'/configs/' . $user->data()->preview_image_url) ) {
									unlink('../app/custmfolders/'.$user->data()->dir_url.'/configs/' . $user->data()->preview_image_url);	
								}
								
								$image = $_FILES['preview__image'];
								$tmp_name = $image['tmp_name'];
								$image_extension = explode('.',$image['name'])[count(explode('.',$image['name'])) - 1];
								move_uploaded_file($tmp_name, "../app/custmfolders/{$user->data()->dir_url}/configs/1.".$image_extension);
								$this->_db->update('users', $user->data()->id, ['preview__image' => 1, 'preview_image_url' => "1.".$image_extension]);
							}


						}
						catch(Exception $e) {
							die($e->getMessgae());
						}
					}
					else {
						foreach($validation->errors() as $error) {
						 	echo $error;
						}
					}

				}
			}
			Redirect::to('home/admin/');
		}


		if(!empty(Input::get('postName'))) {
			if ( empty(Input::get('editPost')) ) {

				$author = $user->data()->id;
				if(!empty( $_FILES['postImage__preview'] )) {
					$image = $_FILES['postImage__preview'];
					$tmp = $image['tmp_name'];
					$name = explode('.',$image['name'])[count(explode('.',$image['name'])) - 1];
					$folds = array($user->data()->id, date('Y'), date('m'), date('d'), date('H')); 
					$path = '../app/custmfolders/posts/';
					foreach ( $folds as $fold ) { 
					
						if(!file_exists($path.$fold)) {
							mkdir($path.$fold);
						}
						$path = $path.$fold.'/';
					}
					$path = $path.date('H').date('i').date('s').'.'.$name;
					$postImgPath = str_replace('../app/custmfolders/posts/', '',$path);
					move_uploaded_file($tmp, $path);
				}

				$tgs = explode('/',Input::get('posttags')); 
				array_shift($tgs);
				$c = 1;
				$tags = array();
				while ( $c <= count($tgs) ) {
					$tags[$c] = $this->_db->first($this->_db->get('tags', array('tag','=',$tgs[$c-1])))->id;
					$c++;
				}

				$tags = json_encode($tags);

				$this->_db->insert('posts', array(
					'author' => $author,
					'title' => Input::get('postName'),
					'image_path' => $postImgPath,
					'tags' => (string)$tags,
					'date' => date('Y-m-d H:i:s'),
					'content' => Input::get('post__content'),
					'views' => 0,
					'comments' => '{}'
				));
			}
			else {

				$post = $this->_db->first($this->_db->get('posts', array('id', '=', Input::get('editPost'))));
				// $this->message('ok', $post);
				$postImgPath = $post->image_path;
				if($_FILES['postImage__preview']['error'] != 4) {
					if(is_file('../app/custmfolders/posts/'.$postImgPath)) {
						unlink('../app/custmfolders/posts/'.$postImgPath);
					}
					$image = $_FILES['postImage__preview'];
					$tmp = $image['tmp_name'];
					$name = explode('.',$image['name'])[count(explode('.',$image['name'])) - 1];

					$folds = array($user->data()->id, date('Y'), date('m'), date('d'), date('H')); 
					$path = '../app/custmfolders/posts/';
					foreach ( $folds as $fold ) { 
					
						if(!file_exists($path.$fold)) {
							mkdir($path.$fold);
						}
						$path = $path.$fold.'/';
					}
					$path = $path.date('H').date('i').date('s').'.'.$name;
					$postImgPath = str_replace('../app/custmfolders/posts/', '',$path);
					move_uploaded_file($tmp, $path);
				}


				$tgs = explode('/',Input::get('posttags')); 
				array_shift($tgs);
				$c = 1;
				$tags = array();
				while ( $c <= count($tgs) ) {
					$tags[$c] = $this->_db->first($this->_db->get('tags', array('tag','=',$tgs[$c-1])))->id;
					$c++;
				}

				$tags = json_encode($tags);

				$this->_db->update('posts', Input::get('editPost'), array(
					'title' => Input::get('postName'),
					'tags' => (string)$tags,
					'content' => Input::get('post__content'),
					'image_path' => $postImgPath
				));
			}

			
		}

		
		//  get cv
		$cv = array();
		if(count($this->_db->get('cv', array('hash', '=', $user->data()->dir_url))->results()) > 0 ) {
			$cv = $this->_db->get('cv', array('hash', '=', $user->data()->dir_url))->first();
			
			$educatons = json_decode($cv->education,true); 
			$education_urls = '';
			foreach ( $educatons as $key => $educaation ) {
				$education_urls .= $key.DIRECTORY_SEPARATOR;

			}
			$cv->education = $educatons;
			$cv->educ_urls = $education_urls;

			$experience = json_decode($cv->experience,true); 

			$exper_urls = '';
			foreach ( $experience as $keyr => $experiencer ) {
				$exper_urls .= $keyr.DIRECTORY_SEPARATOR;
			}
			$cv->experience = $experience;
			$cv->exper_urls = $exper_urls;

			$skills_urls = '';
			$skills = json_decode($cv->skills,true);
			foreach ( $skills as $skill ) {
				$skills_urls .= $skill.DIRECTORY_SEPARATOR; 
			} 
			$cv->skills_urls = $skills_urls;
			$cv->skills = $skills;

			$cv->lang = $this->_db->get('languages', array('id','=', $cv->lang))->first()->lang;

		}


		//  save cv
		if(!empty($_POST['cv__name'])) {

			// cv table config
			// id
			// hash
			// name
			// surname
			// patronymic
			// ava
			// phone
			// birth__year
			// birth__month
			// birth__day
			// email
			// country
			// address
			// linkedin__link
			// fb__link
			// city
			// postal__code
			// instagram__link
			// githab__link
			// gender
			// skills = {}(json)
			// description
			// education = {}
			// experience
			
			//
			

			if( Input::get('skills') != '' ) {
				$skils = explode('/', Input::get('skills'));
			$id = 1;
			$skills_levels = array();
			$skills = array();
			foreach ( $skils as $skil ) {
				if ( $skil != '' ) {
					$skills[$id] = $skil;
					$skills_levels[$skil] = Input::get('cv__skill__level__'.str_replace(' ','',$skil));
					$id++; 
					
				}
			}

			$skills_level = json_encode($skills_levels);	
			}
			else {
				$this->message('error__skills', 'add some skills');
			}
			

			if( Input::get('cv__lang') != '' ) {
				$cv_lang = $this->_db->get('languages', array('lang', '=', strtolower(Input::get('cv__lang'))))->first()->id;	
			}
			else {
				$this->message('error_cv_lang', 'choose cv language');
			}
			

			if(Input::get('cv__education__ids') != '') {
				$education__ids = explode('/', Input::get('cv__education__ids'));
			
			$education = array();
			foreach ( $education__ids as $education__id ) {
				if ( $education__id != '' ) {
					$educ = explode( ' || ', Input::get($education__id) );
					$educ__name = $educ[0];
					$educ__loc = $educ[1];
					$educ__start__date = $educ[2];
					$educ__end__date = $educ[3];
					$educ__descr = $educ[4];
					$educ__start = explode(' -- ', $educ__start__date);
					$educ__end = explode(' -- ', $educ__end__date);

					$education[$education__id] = array(
						'name' => $educ__name,
						'location' => $educ__loc,
						'start__date' => $educ__start,
						'end__date' => $educ__end,
						'description' => $educ__descr
					);

				}
				else {
					continue;
				}
			}
			}
			else {
				$this->message('error_educ', 'add some education');
			}



			if ( Input::get('cv__exeprins__ids') != '' )
			{
				$experience__ids = explode('/', Input::get('cv__exeprins__ids'));

			$experience = array();
			foreach ( $experience__ids as $experience__id ) {
				if ( $experience__id != '' ) {
					$exper = explode( ' || ', Input::get($experience__id) );
					$exper__name__pos = explode( ' -- ' , $exper[0] );
					$exper__name = $exper__name__pos[0];
					$exper__pos = $exper__name__pos[1];

					$exper__loc = $exper[1];
					$exper__start__date = $exper[2];
					$exper__end__date = $exper[3];
					$exper__descr = $exper[4];
					$exper__start = explode(' -- ', $exper__start__date);
					$exper__end = explode(' -- ', $exper__end__date);



					$experience[$experience__id] = array(
						'nameCompany' => $exper__name,
						'positionCompany' => $exper__pos,
						'locationCompany' => $exper__loc,
						'start__dateCompany' => $exper__start,
						'end__dateCompany' => $exper__end,
						'descriptionCompany' => $exper__descr
					);

				}
				else {
					continue;
				}
			}
			}
			else {
				$this->message('error_exper', 'add Previuos experience');
			}



			if(count($this->_db->get('cv', array('hash', '=', $user->data()->dir_url))->results()) == 0) {

				$this->_db->insert('cv', array(
					'hash' => $user->data()->dir_url,
					'name' => Input::get('cv__name'),
					'surname' => Input::get('cv__surname'),
					'patronymic' => Input::get('cv__patronymic'),
					'ava' => Input::get('cv__ava'),
					'phone' => Input::get('cv__phone'),
					'birth__year' => (int)Input::get('Byear'),
					'birth__month' => (int)Input::get('Bmonth'),
					'birth__day' => (int)Input::get('Bday'),
					'email' => Input::get('cv__email'),
					'country' => Input::get('cv__country'),
					'adress' => Input::get('cv__address'),
					'linkedin__link' => Input::get('cv__linkedin__link'),
					'fb__link' => Input::get('cv__facebook__link'),
					'city' => Input::get('cv__city'),
					'postal__code' => Input::get('cv__postal'),
					'instagram__link' => Input::get('cv__instagram__link'),
					'githab__link' => Input::get('cv__githab__link'),
					'gender' => Input::get('cvGender'),
					'skills' => json_encode($skills),
					'description' => Input::get('cv__description__content'),
					'education' => json_encode($education),
					'experience' => json_encode($experience),
					'proffecion' => Input::get('cv__profeccion'),
					'lang' => $cv_lang,
					'skills_level' => $skills_level

				));
				
			}
			// proffecion
			// lang
			// skills_level
			else {
				$cv_id = $this->_db->get('cv', array('hash','=', $user->data()->dir_url))->first()->id;

				$this->_db->update('cv', $cv_id, array(
					'name' => Input::get('cv__name'),
					'surname' => Input::get('cv__surname'),
					'patronymic' => Input::get('cv__patronymic'),
					'ava' => Input::get('cv__ava'),
					'phone' => Input::get('cv__phone'),
					'birth__year' => (int)Input::get('Byear'),
					'birth__month' => (int)Input::get('Bmonth'),
					'birth__day' => (int)Input::get('Bday'),
					'email' => Input::get('cv__email'),
					'country' => Input::get('cv__country'),
					'adress' => Input::get('cv__address'),
					'linkedin__link' => Input::get('cv__linkedin__link'),
					'fb__link' => Input::get('cv__facebook__link'),
					'city' => Input::get('cv__city'),
					'postal__code' => Input::get('cv__postal'),
					'instagram__link' => Input::get('cv__instagram__link'),
					'githab__link' => Input::get('cv__githab__link'),
					'gender' => Input::get('cvGender'),
					'skills' => json_encode($skills),
					'description' => Input::get('cv__description__content'),
					'education' => json_encode($education),
					'experience' => json_encode($experience),
					'proffecion' => Input::get('cv__profeccion'),
					'lang' => $cv_lang,
					'skills_level' => $skills_level
				));
			}

			$this->message('ok', '');


		}




		// add work 
		if(!empty(Input::get('workName'))) {

			if(empty(Input::get('editWork'))) {
				$author = $user->data()->id;

				if(!empty( $_FILES['workImage__preview'] )) {
					$image = $_FILES['workImage__preview'];
					$tmp = $image['tmp_name'];
					$name = explode('.',$image['name'])[count(explode('.',$image['name'])) - 1];
					$imagePath =  'works/images/'.date('Y').date('m').date('d').date('H').date('i').date('s').'.'.$name;
					move_uploaded_file($tmp, '../app/custmfolders/'.$user->data()->dir_url.'/'.$imagePath);
				}
				if( Input::get('fileType') == 'url' ) {
					$site = 1;
					$link = Input::get('workLink');
					// $this->message('ok', $link);
				}
				else {
					$site = 0;
					if(!empty($_FILES['workZip'])) {
						$zip = $_FILES['workZip'];
						$name = explode('.',$zip['name'])[count(explode('.',$zip['name'])) - 1];
						$extensions = array('rar', 'zip', '7z');
						if ( in_array($name, $extensions) ) {
							$link = '../app/custmfolders/'.$user->data()->dir_url . '/works/zips/'.date('Y').date('m').date('d').date('H').date('i').date('s').'.'.$name;
							move_uploaded_file($zip['tmp_name'], $link);
						}
						else {

						}

					}

				}

				$category = $this->_db->first($this->_db->get('categories', array('category_name','=', Input::get('workCategory'))))->id;

				$tgs = explode('/',Input::get('worktags')); 
				array_shift($tgs);
				$c = 1;
				$tags = array();
				while ( $c <= count($tgs) ) {
					$tags[$c] = $this->_db->first($this->_db->get('tags', array('tag','=',$tgs[$c-1])))->id;
					$c++;
				}

				$tags = json_encode($tags);



				$this->_db->insert('works', array(
					'user_id' => $author,
					'category' => $category,
					'title' => Input::get('workName'),
					'image' => $imagePath,
					'prev_text' => Input::get('WorkDesc'),
					'tags' => $tags,
					'link' => $link,
					'site' => $site,
					'date' => date('Y-m-d H:i:s'),
					'full_content' => Input::get('work__content'),
					'views' => 0,
					'likes' => 0,
					'dislikes' => 0,
					'liked' => '',
					'downloads_linked' => 0
				));
					
			}
			else {
				$workId = Input::get('editWork');
				$work = $this->_db->first($this->_db->get('works',array('id','=',$workId)));
				$imagePath = $work->image;
				if($_FILES['workImage__preview']['error'] != 4) {
					if(is_file('../app/custmfolders/'.$user->data()->id.'/'.$work->image)) {
						unlink('../app/custmfolders/'.$user->data()->id.'/'.$work->image);
					}
					$image = $_FILES['workImage__preview'];
					$tmp = $image['tmp_name'];
					$name = explode('.',$image['name'])[count(explode('.',$image['name'])) - 1];
					$imagePath =  'works/images/'.date('Y').date('m').date('d').date('H').date('i').date('s').'.'.$name;
					move_uploaded_file($tmp, '../app/custmfolders/'.$user->data()->dir_url.'/'.$imagePath);
					
				}

				$tag = $this->_db->first($this->_db->get('tags', array('tag','=',Input::get('workTag'))))->id;


				if ( $work->site == 1 ) {
					if (Input::get('fileType') == 'url') {
						$site = 1;
						$link = Input::get('workLink');
					}
					else {
						$site = 0;

						if($_FILES['workZip']['error'] != 4) {
							$zip = $_FILES['workZip'];
							$name = explode('.',$zip['name'])[count(explode('.',$zip['name'])) - 1];
							$extensions = array('rar', 'zip', '7z');
							if ( in_array($name, $extensions) ) {
								$link = '../app/custmfolders/'.$user->data()->dir_url . '/works/zips/'.date('Y').date('m').date('d').date('H').date('i').date('s').'.'.$name;
								move_uploaded_file($zip['tmp_name'], $link);
							}

						}
			
					}
				}
				else {
					if ( Input::get('fileType') == 'file' ) {
						$site = 0;
						if($_FILES['workZip']['error'] != 4) {
							if( is_file($work->link) ) {
								unlink($work->link);
							}
							$zip = $_FILES['workZip'];
							$name = explode('.',$zip['name'])[count(explode('.',$zip['name'])) - 1];
							$extensions = array('rar', 'zip', '7z');
							if ( in_array($name, $extensions) ) {
								$link = '../app/custmfolders/'.$user->data()->dir_url . '/works/zips/'.date('Y').date('m').date('d').date('H').date('i').date('s').'.'.$name;
								move_uploaded_file($zip['tmp_name'], $link);
							}

						}
					}
					else {
						$site = 1;
						if( is_file($work->link) ) {
							unlink($work->link);
						}
						$link = Input::get('workLink');
					}
				}

				$tgs = explode('/',Input::get('worktags')); 
				array_shift($tgs);
				$c = 1;
				$tags = array();
				while ( $c <= count($tgs) ) {
					$tags[$c] = $this->_db->first($this->_db->get('tags', array('tag','=',$tgs[$c-1])))->id;
					$c++;
				}
				
				$tags = json_encode($tags);
				$category = $this->_db->first($this->_db->get('categories', array('category_name','=', Input::get('workCategory'))))->id;






				$this->_db->update('works',	$workId , array(
					'title' => Input::get('workName'),
					'image' => $imagePath,
					'category' => $category,
					'prev_text' => Input::get('WorkDesc'),
					'tags' => (string)$tags,
					'link' => $link,
					'site' => $site,
					'full_content' => Input::get('work__content'),
				));
			}					
		}

// FRIENDS



		// friend removing
		if( !empty(Input::get('removeFriend')) ) {
			$chat_hashes_to_remove = $this->_db->get('chat_hash')->results();
			$chat_hash__to_remove = '';
			$chat_rem_id = 0;
			foreach ( $chat_hashes_to_remove as $hashe ) {
				if( $hashe->user_from == $user->data()->id && $hashe->user_to == Input::get('removeFriend') ) {
					$chat_hash__to_remove = $hashe->hash;
					$chat_rem_id = $hashe->id;
					break;
				}
				else if ($hashe->user_to == $user->data()->id && $hashe->user_from == Input::get('removeFriend')) {
					$chat_hash__to_remove = $hashe->hash;
					$chat_rem_id = $hashe->id;
					break;
				}
				else {

					continue;
				}
			}
			// $this->message('success', $chat_rem_id);

			$messages_to_remove = $this->_db->get('messages', array('hash','=',$chat_hash__to_remove))->results();
			foreach( $messages_to_remove as $mess_to_rem ) {
				$this->_db->delete('messages', array('id','=',$mess_to_rem->id));
			}
			$this->_db->delete('chat_hash', array('id','=',$chat_rem_id));

			$freeks = json_decode($user->data()->friends, true);
			$result = array();
			function deleteFriend( $id, $list ) {
				$result = array();
				foreach( $list as $freek ) {
					if( $freek != $id ) {
						$result[] = $freek;
					}
					else {
						continue;
					}
				} 
				return $result;
			}
			$resut = deleteFriend(Input::get('removeFriend'), $freeks);
			$resut2 = deleteFriend($user->data()->id, json_decode($this->_db->first($this->_db->get('users', array('id','=',Input::get('removeFriend'))))->friends, true));
			foreach( array_keys($resut) as $key ) {
				$result[(string)($key+1)] = $resut[$key];
			}
			foreach( array_keys($resut2) as $key ) {
				$result2[(string)($key+1)] = $resut2[$key];
			}
			$this->_db->update('users', $user->data()->id, array('friends' => json_encode($result)));
			$this->_db->update('users', Input::get('removeFriend'), array('friends' => json_encode($result2)));
			$this->message('success', 'success');
		}


		// friend accepting
		if( !empty(Input::get('acceptFriend')) ) {
			$freeks = json_decode($user->data()->friends, true);
			$result = array();
			function addFriend( $id, $list ) {

				$list[(string)(count($list)+1)] = $id; 
				return $list;
			}
			$requests = $this->_db->results($this->_db->get('requests', array('to_user', '=', $user->data()->id)));
			foreach( $requests as $request ) {
				if($request->type == 1 && $request->status == 0) {
					if ( $request->from_user == Input::get('acceptFriend') ) {
						$this->_db->delete('requests', array('id','=', $request->id));
					} 
				}
			}
			$hash= Hash::salt(16);
			mkdir('../app/custmfolders/messanger/'.$hash);
			
			$this->_db->insert('chat_hash', array(
				'hash' => $hash,
				'user_from' => Input::get('acceptFriend'),
				'user_to' => $user->data()->id
			));
			$result = addFriend(Input::get('acceptFriend'), $freeks);
			$result2 = addFriend($user->data()->id, json_decode($this->_db->first($this->_db->get('users', array('id','=',Input::get('acceptFriend'))))->friends, true));
			$this->_db->update('users', $user->data()->id, array('friends' => json_encode($result)));
			$this->_db->update('users', Input::get('acceptFriend'), array('friends' => json_encode($result2)));
			$this->message('success', $requests);
		}


		if( !empty(Input::get('declineFriend')) ) {
			$freeks = json_decode($user->data()->friends, true);
			$result = array();
			$requests = $this->_db->results($this->_db->get('requests', array('to_user', '=', $user->data()->id)));
			foreach( $requests as $request ) {
				if($request->type == 1 && $request->status == 0) {
					$this->_db->update('requests', $request->id, array('status' => '-1'));
				}
			}
			$this->message('success', Input::get('declineFriend'));
		}
		if( !empty(Input::get('sendFriendrequest')) ) {
			$requests = $this->_db->results($this->_db->get('requests', array('to_user', '=', Input::get('sendFriendrequest'))));
			foreach( $requests as $request ) {
				if($request->type == 1 && $request->status == '-1') {
					if ( $request->to_user == Input::get('sendFriendrequest') ) {
						$this->_db->delete('requests', array('id','=', $request->id));
					} 
				}
			}
			$this->_db->insert('requests', array(
				'type' => 1,
				'from_user' => $user->data()->id,
				'to_user' => (int)Input::get('sendFriendrequest'),
				'status' => '0'
			));
			$this->message('success', Input::get('sendFriendrequest'));
		}





		// works
		if( !empty(Input::get('workRemoveId')) ) {
			$this->_db->delete('works', array('id', '=', Input::get('workRemoveId')));
			$this->message('ok',Input::get('workRemoveId'));
		}
		if( !empty(Input::get('workEditId')) ) {
			if(Input::get('editWork') == true) {
				$work = $this->_db->first($this->_db->get('works', array('id','=',Input::get('workEditId'))));
				$work->category = $this->_db->first($this->_db->get('categories',array('id','=',$work->category)))->category_name;
				$tags = array();
				foreach ( json_decode($work->tags, true) as $tg ) {
					$tags[] = $this->_db->first($this->_db->get('tags', array('id','=',$tg)))->tag;
				}
				$work->tags = $tags;


				$work->dir = $user->data()->dir_url;
				$this->message('ok',$work);
			}
		}



		// profile load
		$profile = $user;
		$categories = $this->_db->results($this->_db->get('categories'));
		$profs = $this->_db->results($this->_db->get('proffesions'));
		foreach( $profs as $prof ) {
			if( $user->data()->prof == $prof->id ) {
				$user->data()->prof = $prof->prof_name;
			}
		}
		foreach( $categories as $category ) {
			if( $user->data()->category == $category->id ) {
				$user->data()->category = $category->category_name;
			}
		}
		// friends
		$friends_ids = json_decode($user->data()->friends);
		$friends = array();

		foreach( $friends_ids as $friend_id ) {
			$friend = $this->_db->first($this->_db->get('users', array('id','=',$friend_id)));

			foreach( $profs as $prof ) {
				if( $friend->prof == $prof->id ) {
					$friend->prof = $prof->prof_name;
				}
			}
			foreach( $categories as $category ) {
				if( $friend->category == $category->id ) {
					$friend->category = $category->category_name;
				}
			}

			$friends[] = $friend;
		}
		$user->data()->friends = $friends;
		$reqs = $this->_db->results($this->_db->get('requests', array('to_user', '=', $user->data()->id)));
		$requests = array();
		foreach($reqs as $req) {
			if ( $req->type == 1 && $req->status == 0 ) {
				$req->from_user = $this->_db->first($this->_db->get('users', array('id', '=',$req->from_user)));
				foreach( $profs as $prof ) {
					if( $req->from_user->prof == $prof->id ) {
						$req->from_user->prof = $prof->prof_name;
					}
				}
				foreach( $categories as $category ) {
					if( $req->from_user->category == $category->id ) {
						$req->from_user->category = $category->category_name;
					}
				}
				$requests[] = $req;
			}
		}

		$reqs = $this->_db->results($this->_db->get('requests', array('to_user', '=', $user->data()->id)));
		$requests = array();
		foreach($reqs as $req) {
			if ( $req->type == 1 && $req->status == 0 ) {
				$req->from_user = $this->_db->first($this->_db->get('users', array('id', '=',$req->from_user)));
				foreach( $profs as $prof ) {
					if( $req->from_user->prof == $prof->id ) {
						$req->from_user->prof = $prof->prof_name;
					}
				}
				foreach( $categories as $category ) {
					if( $req->from_user->category == $category->id ) {
						$req->from_user->category = $category->category_name;
					}
				}
				
				$req->from_user->ava = '../app/custmfolders/' . $req->from_user->dir_url . '/' . $req->from_user->ava;
				
				$requests[] = $req;
			}
		}

		
		
		$decs = $this->_db->results($this->_db->get('requests', array('from_user', '=', $user->data()->id)));
		$declined = array();
		foreach($decs as $req) {
			if ( $req->type == 1 && $req->status == '-1' ) {
				$req->to_user = $this->_db->first($this->_db->get('users', array('id', '=',$req->to_user)));
				foreach( $profs as $prof ) {
					if( $req->to_user->prof == $prof->id ) {
						$req->to_user->prof = $prof->prof_name;
					}
				}
				foreach( $categories as $category ) {
					if( $req->to_user->category == $category->id ) {
						$req->to_user->category = $category->category_name;
					}
				}
				$declined[] = $req;
			}
		}

		
		
		// WORKS
		$works = $this->_db->results($this->_db->get('works', array('user_id', '=', $user->data()->id)));
		$tags = $this->_db->results($this->_db->get('tags'));
		foreach( $works as $work ) {
			$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;
			$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
			$wrk_tgs = array();
			foreach( json_decode($work->tags, true) as $tag_item ) {
				$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
			}
			$work->tag = $wrk_tgs;
		}		

		$posts = array_reverse($this->_db->results($this->_db->get('posts', array('author','=',$user->data()->id))));
		
		foreach($posts as $post) {
			$posttags = json_decode($post->tags,true);
			$posttgs = array();
			foreach($posttags as $tg) {
				foreach($tags as $tag) {
					if ( $tg == $tag->id ) {
						$posttgs[] = $tag->tag;
					}
				}
			}
			$post->tags = $posttgs;
		}


		// files

		$file__dir = '../app/custmfolders/' . $user->data()->dir_url . '/images/contents/';



		$files = array();
		$filesy = array_diff(scandir($file__dir), array('.', '..'));

		foreach($filesy as $file) {
			$Year = $file;

			$months = array_diff(scandir($file__dir.$file), array('.', '..'));

			
			foreach( $months as $month ) {
				$Month = $month;

				$days = array_diff(scandir($file__dir.$Year.DIRECTORY_SEPARATOR.$Month), array('.', '..'));
				foreach ( $days as $day ) { 
					$Day = $day;
					$dayFiles = array_diff(scandir($file__dir.$Year.DIRECTORY_SEPARATOR.$Month.DIRECTORY_SEPARATOR.$Day), array('.', '..'));

					foreach ( $dayFiles as $dayFile) {  
						// HTTP_HOST
						$host = $_SERVER['REQUEST_SCHEME'].':'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$_SERVER['HTTP_HOST'];
						$path = $file__dir.$Year.DIRECTORY_SEPARATOR.$Month.DIRECTORY_SEPARATOR.$Day.DIRECTORY_SEPARATOR.$dayFile;
						$path = str_replace('..', $host, $path);
						$files[$Day.'.'.$Month.'.'.$Year][] = array('name' => $dayFile, 'path' => $path); 
					}
				}

			}
			
		}


		$langs = $this->_db->get('languages')->results();

		$this->view('stockexchange/home/admin', [
			'user'=>$user, 
			'cv_fold' => $cv_json_dir,
			'profs' => $profs, 
			'categories' => $categories, 
			'requests' => $requests, 
			'declined' => $declined, 
			'works' => array_reverse($works),
			'tags' => $tags,
			'posts' => $posts,
			'files' => array_reverse($files),
			'main__path' => $file__dir,
			'cv' => $cv,
			'langs' => $langs
		]);
	}


	public function getContentFiles() {
		$user = $this->model('User');
		$file__dir = '../app/custmfolders/' . $user->data()->dir_url . '/images/contents/';



		$files = array();
		$filesy = array_diff(scandir($file__dir), array('.', '..'));

		foreach($filesy as $file) {
			$Year = $file;

			$months = array_diff(scandir($file__dir.$file), array('.', '..'));

			
			foreach( $months as $month ) {
				$Month = $month;

				$days = array_diff(scandir($file__dir.$Year.DIRECTORY_SEPARATOR.$Month), array('.', '..'));
				foreach ( $days as $day ) { 
					$Day = $day;
					$dayFiles = array_diff(scandir($file__dir.$Year.DIRECTORY_SEPARATOR.$Month.DIRECTORY_SEPARATOR.$Day), array('.', '..'));

					foreach ( $dayFiles as $dayFile) {  
						// HTTP_HOST
						$host = $_SERVER['REQUEST_SCHEME'].':'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$_SERVER['HTTP_HOST'];
						$path = $file__dir.$Year.DIRECTORY_SEPARATOR.$Month.DIRECTORY_SEPARATOR.$Day.DIRECTORY_SEPARATOR.$dayFile;
						$path = str_replace('..', $host, $path);
						$files[] = array('name' => $dayFile,'path' => $path); 
					}
				}

			}
			
		}
		$this->message('ok',array_reverse($files));
	}


	public function loadFiles() {
		$user = $this->model('User');
		$file__dir = '../app/custmfolders/' . $user->data()->dir_url . '/images/contents/';
		
		if(!empty($_FILES['uploadImageManager'])) {

			$images = $_FILES['uploadImageManager'];
			$imager = array();
			$length = count($images['name']);

			$times = array(date('Y'), date('m'), date('d'));

			foreach ( $times as $time ) {

				if ( !is_dir($file__dir.$time) ) {

					mkdir($file__dir.$time);
					$file__dir = $file__dir.$time.DIRECTORY_SEPARATOR;

				}
				else {
					$file__dir = $file__dir.$time.DIRECTORY_SEPARATOR;
					continue;
				}
			}
			


			$images__info = array();
			$file__image__paths = array();
			$host = $_SERVER['HTTP_ORIGIN'];
			
			for ( $i = 0; $i < $length; $i++ ) {
				$image_name = $images['name'][$i];
				$tmp_name = $images['tmp_name'][$i];
				if (file_exists($file__dir.$image_name)) {
					$this->message('error', 'Please choose another name to your image');
				}
				move_uploaded_file($tmp_name, $file__dir.$image_name);

				

				$file__image__path = str_replace('..', $host, $file__dir) . $image_name;

				$images__info[] = array(
					'path' => $file__image__path,
					'name' => $image_name,
					'time' => $times
				);

			}
			

			

			$this->message('ok', $images__info);
		}
	}


	public function search($search) {
		
		//get search query
		$search_query = $this->_db->get('requests', array('status', '=', $search))->first();

		if ( empty($search_query) ) {
			Redirect::to('home/index/');
		}

		$this->_db->delete('requests', array('status', '=', $search));

		// find users
		$users_username = $this->_db->getlike('users', array('username'), $search_query->messages)->results();
		$users_email = $this->_db->getlike('users', array('email'), $search_query->messages)->results();
		$users_fullname = $this->_db->getlike('users', array('fullname'), $search_query->messages)->results();

		$users = array();
		if ( count( $users_username ) > 0  ) {
			foreach( $users_username as $un ) {
				$users[$un->id] = $un;
			}

		}
		
		if(count($users_email) > 0) {
			foreach( $users_email as $un ) {
				$users[$un->id] = $un;
			}	
		}
		
		if( count( $users_fullname ) > 0 ) {
			foreach( $users_fullname as $un ) {
				$users[$un->id] = $un;
			}
		}

		if ( count($users) > 0 ) {
			foreach( $users as $user ) {
				$user->category = $this->_db->get('categories', array('id', '=', $user->category))->first()->category_name;
				$user->prof = $this->_db->get('proffesions', array('id', '=', $user->prof))->first()->prof_name;
			}	
		}

		// find works
		$work__title = $this->_db->getlike('works', array('title'), $search_query->messages)->results();
		$work__shtdesc = $this->_db->getlike('works', array('prev_text'), $search_query->messages)->results();
		$work__content = $this->_db->getlike('works', array('full_content'), $search_query->messages)->results();


		$works = array();

		if( count($work__title) > 0 ) {
			foreach( $work__title as $un ) {
				$works[$un->id] = $un;
			}	
		} 
		

		if ( count($work__shtdesc) > 0 ) {
			foreach( $work__shtdesc as $un ) {
				$works[$un->id] = $un;
			}	
		} 
		
		if(count($work__content) > 0 ) {
			foreach( $work__content as $un ) {
				$works[$un->id] = $un;
			}	
		}
		

		if ( count($works) > 0 ) {
			foreach( $works as $work ) {
				$work->category = $this->_db->get('categories', array('id', '=', $work->category))->first()->category_name;
			}	
		} 
		// find posts 

		$post__title = $this->_db->getlike('posts', array('title'), $search_query->messages)->results();
		$post__content = $this->_db->getlike('posts', array('content'), $search_query->messages)->results();

		$posts = array();

		if( count($post__title) > 0 ) {
			foreach( $post__title as $un ) {
				$posts[$un->id] = $un;
			}	
		} 
				
		if(count($post__content) > 0 ) {
			foreach( $post__content as $un ) {
				$posts[$un->id] = $un;
			}	
		}

		if( count( $posts ) > 0 ) {
			foreach( $posts as $post ) {
				$post__tags = json_decode($post->tags, true);
				$tags = array();
				foreach( $post__tags as $psttg ) {
					$tags[] = $this->_db->get('tags', array('id','=', $psttg))->first()->tag;
				}
				$post->tags = $tags;
			} 
		}

		// decalre array of output data
		$searches['users'] = $users;
		$searches['works'] = $works;
		$searches['posts'] = $posts;

		// render the ciew with data
		$this->view('stockexchange/home/search', ['search' => $search_query->messages, 'searches' => $searches]);
	}


// RESET
	public function reset() {
		$this->isLogged();
		$user = $this->model('User');
		$form = $this->form('stockexchange', 'reset');

		if(Input::exists()) {
			if(Token::check(Input::get('token'))) {
				$validate = $this->model('Validate');
				$validation = $validate->check($_POST, array(
					'password' => array(
						'required' => true,
					),
					'new__password' => array(
						'required' => true,
						'min' => 6
					),
					'new__password__again' => array(
						'required' => true,
						'matches' => 'new__password'
					)
				));
				if($validation->passed()) {
					$salt = Hash::salt(16);
					
					try {
							
						if( $user->data()->password === Hash::make(Input::get('password'), $user->data()->salt) ) {
							$this->_db->update('users', $user->data()->id, array(
								'password' => Hash::make(Input::get('new__password'), $user->data()->salt)
							));
						}
						Redirect::to('home/admin/');
					}
					catch(Exception $e) {
						die($e->getMessage());
					}
				}
				else {
					foreach($validation->errors() as $error) {
						echo $error.'<br>';
					}
				}
			}
		}


		$this->view('stockexchange/home/reset', ['form'=>$form]);
	}


// LOGOUT
	public function logout() {
		$this->isLogged();
		
		$user = $this->model('User');
			
		$this->_db->update('users', $user->data()->id,array('activity' => '0'));
		$user->logout();
		Redirect::to();
	}


	public function message($status, $message) {
		exit(json_encode(['status'=> $status, 'message'=> $message]));
	}

	public function messageMessanger($status, $message,$user) {
		exit(json_encode(['status'=> $status, 'message'=> $message,'user'=>$user]));
	}

	public function newMessage($messages) {
		exit(json_encode(['messages'=> $messages, 'status'=> 'ok']));

	}

	public function imgsrc($src, $width, $height) {
		exit(json_encode(['src'=> $src, 'width' => $width, 'height' => $height]));
	}

	public function activity() {
		$this->_db->update('users', $this->model('User')->data()->id, array('activity'=>Input::get('activity')));
		exit(json_encode(array('status'=>Input::get('activity'))));
	}

	public function translate() {
		if(!empty($_POST['lang'])) {
			if(Input::get('lang') != 'all') {
				$tranlations = $this->_db->results($this->_db->get('translations'));
				$lang = $this->_db->first($this->_db->get('languages', array('lang', '=',$_POST['lang'])))->id;
				$this->tranlate($lang,$tranlations);
			}
			else if ( Input::get('lang') == 'all' ) {
				$tranlations = $this->_db->results($this->_db->get('translations'));
				$this->tranlate(Session::get('lang'),$tranlations );
				
			}
			
		}
	}

	public function friendship($towho_id) {

		$this->_db->insert('requests', array(
			'type' => 1,
			'from_user' => $this->model('User')->data()->id,
			'to_user' => (int)$towho_id,
			'status' => 0
		));

		$this->message($this->model('User')->data()->id, $towho_id);
	}

	public function checkactivity() {
		if(!empty(Input::get('checkAct'))) {
			$id = Input::get('checkAct');
			exit(json_encode(['id' => Input::get('checkAct'),'active_nor_not'=>$this->_db->first($this->_db->get('users', array('id','=', $id)))->activity]));
		}
	}

	public function likedsislike () {
		if (!empty(Input::get('workId'))) {
			$work = $this->_db->first($this->_db->get('works', array('id','=', Input::get('workId'))));
			$work_likes = $work->likes;
			$work_dislikes = $work->dislikes;
			$work_liked = $work->liked;

			if($work_liked == "") {
				if(Input::get('like') == '+') {
					$work_liked = json_encode(array((string)$this->model("User")->data()->id => "1"));
					$work_likes = 1;
				}
				else if ( Input::get('like') == '-' ) {
					$work_liked = json_encode(array((string)$this->model("User")->data()->id => "0"));
					$work_dislikes = 1;	
				}

			}
			else {
				$liked = json_decode($work_liked, true);
				if( Input::get('like') == '+' ) {
					if ( array_key_exists($this->model('User')->data()->id, $liked) ) {
						$user_liked = $liked[$this->model('User')->data()->id];
						if( $user_liked != "1" ) {
							
							$work_dislikes = $work_dislikes - 1;
							$work_likes = $work_likes + 1;
							$liked[$this->model('User')->data()->id] = "1";
						}
					}
					else {
						$work_likes = $work_likes + 1;
						$liked[$this->model('User')->data()->id] = "1";
					}
				}
				else if ( Input::get('like') == '-' ) {
					if ( array_key_exists($this->model('User')->data()->id, $liked) ) {
						$user_liked = $liked[$this->model('User')->data()->id];
						if( $user_liked != "0" ) {
							
							$work_dislikes = $work_dislikes + 1;
							$work_likes = $work_likes - 1;
							// $work_liked[]
							$liked[$this->model('User')->data()->id] = "0";
						}
					}
					else {
						$work_dislikes = $work_dislikes + 1;
						$liked[$this->model('User')->data()->id] = "0";
					}
				}
				$work_liked = json_encode($liked);
			}


			$this->_db->update('works', Input::get('workId'), array(
				'likes' => $work_likes,
				'dislikes' => $work_dislikes,
				'liked' => $work_liked
			));

			$this->message('ok',['likes' => $work_likes, 'dislikes' => $work_dislikes, 'liked' => $work_liked]);

		}
	}

	public function filter () {
		

		if ( Input::get('filterId') != 'all' ) {

		
			if(!empty(Input::get('filterItem'))) {
				$result = array();
				if(Input::get('filterItem') == 'works' ) {

					if (Input::get('filterId')['tag'] == '') {

					$key = array_keys(Input::get('filterId'))[0];

					$works = $this->_db->results($this->_db->get(Input::get('filterItem'), array($key, '=',Input::get('filterId')[$key])));

					$tags = $this->_db->results($this->_db->get('tags'));

					$catefories = $this->_db->results($this->_db->get('categories'));
					$profs = $this->_db->results($this->_db->get('proffesions'));
					foreach( $works as $work ) {
						$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;
						$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
						$wrk_tgs = array();
						foreach( json_decode($work->tags, true) as $tag_item ) {
							$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
						}
						$work->tag = $wrk_tgs;

						$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
						$work->user = [
							'fullname' => $workUser->fullname,
							'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
							'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
						];
					}
					if ( $works != null ) {
						$result = array_reverse($works);
					}

					$this->filterResult(Input::get('filterItem'), $result);
					}
					else {
						$result = array();

						$tagr = $this->_db->first($this->_db->get('tags',array('tag','=',Input::get('filterId')['tag'])))->id;

						$check_tags = array();
						if(Input::get('filterId')['category'] != '' ) {

							$works = $this->_db->results($this->_db->get('works', array('category','=',Input::get('filterId')['category'])));

							foreach( $works as $work ) {
								$tags = json_decode($work->tags, true);

								$tag__exitsting = false;
								if(in_array($tagr, $tags) ) {
									$tag__exitsting = true;
								}

								if ( $tag__exitsting == true ) {
									$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;
										$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
										$wrk_tgs = array();
										foreach( json_decode($work->tags, true) as $tag_item ) {
											$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
										}
										$work->tag = $wrk_tgs;

										$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
										$work->user = [
											'fullname' => $workUser->fullname,
											'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
											'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
										];

										$work_resulted[] = $work;
								}

							}

							if ( $work_resulted != null ) {
								$result = array_reverse($work_resulted);
							}

							$this->filterResult(Input::get('filterItem'), $result);
						}
						else {
							$works = $this->_db->results($this->_db->get('works'));
							$tagr = $this->_db->first($this->_db->get('tags',array('tag','=',trim(Input::get('filterId')['tag']))))->id;

							foreach( $works as $work ) {
								$tags = json_decode($work->tags, true);

								$tag__exitsting = false;
								if(in_array($tagr, $tags) ) {
									$tag__exitsting = true;
								}

								if ( $tag__exitsting == true ) {
										$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;
										$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
										$wrk_tgs = array();
										foreach( json_decode($work->tags, true) as $tag_item ) {
											$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
										}
										$work->tag = $wrk_tgs;
										
										$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
										$work->user = [
											'fullname' => $workUser->fullname,
											'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
											'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
										];

										$work_resulted[] = $work;
								}

							}

							if ( $work_resulted != null ) {
								$result = array_reverse($work_resulted);
							}
							
							$this->filterResult(Input::get('filterItem'), $result);
						}


						
					}
				}
				else if ( Input::get('filterItem') == 'users' ) {
					$result = array();
					if( count(Input::get('filterId')) > 1 ) {
						$keys = array_keys(Input::get('filterId'));
						$key1 = $keys[0];

						$users = $this->_db->results($this->_db->get(Input::get('filterItem')));

						foreach( $users as $user ) {
							if ( $user->{$keys[1]} == Input::get('filterId')[$keys[1]] && $user->{$key1} == Input::get('filterId')[$key1]) {
								$user->category = $this->_db->first($this->_db->get('categories', array('id','=',$user->category)))->category_name;
								$user->prof = $this->_db->first($this->_db->get('proffesions', array('id','=',$user->prof)))->prof_name;
								$resulted_users[] = $user;
							}
						}
						$result = $resulted_users;




						$this->filterResult(Input::get('filterItem'), $result);

					}
					else {
						
						$key = array_keys(Input::get('filterId'))[0];


						$users = $this->_db->results($this->_db->get(Input::get('filterItem'), array(Input::get('filterBy'), '=',Input::get('filterId')[$key])));


						$catefories = $this->_db->results($this->_db->get('categories'));
						$profs = $this->_db->results($this->_db->get('proffesions'));
						foreach( $users as $user ) {
							$user->category = $this->_db->first($this->_db->get('categories', array('id','=',$user->category)))->category_name;
							$user->prof = $this->_db->first($this->_db->get('proffesions', array('id','=',$user->prof)))->prof_name;
						}
						$result = $users;




					
						$this->filterResult(Input::get('filterItem'), $result);
					}
				}


			} // closses second input emptyfilter Item 
		}
		else if (  Input::get('filterId') == 'all'  ) {
			if ( Input::get('filterItem') == 'users' ) {
				$users = $this->_db->results($this->_db->get(Input::get('filterItem')));

				foreach( $users as $user ) {
					$user->category = $this->_db->first($this->_db->get('categories', array('id','=',$user->category)))->category_name;
					$user->prof = $this->_db->first($this->_db->get('proffesions', array('id','=',$user->prof)))->prof_name;
				}
				$result = $users;

				$this->filterResult(Input::get('filterItem'), $result);
			}
			else if ( Input::get('filterItem') == 'works' ) {
				$works = $this->_db->results($this->_db->get(Input::get('filterItem')));


				$tags = $this->_db->results($this->_db->get('tags'));

				foreach( $works as $work ) {
					$work->category = $this->_db->first($this->_db->get('categories', array('id','=',$work->category)))->category_name;
					$work->user_dir = $this->_db->first($this->_db->get('users', array('id', '=', $work->user_id)))->dir_url;
					$wrk_tgs = array();
					foreach( json_decode($work->tags, true) as $tag_item ) {
						$wrk_tgs[] = $this->_db->first($this->_db->get('tags', array('id','=', $tag_item)))->tag;
					}
					$work->tag = $wrk_tgs;


					$workUser = $this->_db->first($this->_db->get('users', array('id','=', $work->user_id)));
					$work->user = [
						'fullname' => $workUser->fullname,
						'ava' => '../app/custmfolders/' . $workUser->dir_url . '/' . $workUser->ava,
						'category' => $this->_db->first($this->_db->get('categories', array('id','=', $workUser->category)))->category_name
					];
				}
				$result = array_reverse($works);




				
				$this->filterResult(Input::get('filterItem'), $result);
			}

			
		}

	} // closes method

	public function filterResult($what, $result) {
		exit(json_encode(array('what'=> $what,'result' => $result)));
	}

	public function setSearch() {
		if(!empty(Input::get('search'))) {
			$hash = Hash::salt(16);
			$this->_db->insert('requests', array ( 
				'type' => 2, 
				'from_user' => 0,
				'to_user' => 0,
				'messages' => Input::get('search'),
				'status' => $hash 
			));

			$this->message('ok', $hash);
		}
	}

	public function getLang() {
		exit(json_encode(array('lang'=>$this->_db->get('languages', array('id','=',Session::get('lang')))->first()->lang)));
	}

	public function isLogged($log_reg_form = false) {
		if(!$this->model('User')->isLoggedIn()) {
			Redirect::to('home/login/');		
		}
	}

}





















