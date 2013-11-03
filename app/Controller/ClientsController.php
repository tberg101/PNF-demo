<?php
App::uses('AppController', 'Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 */
class ClientsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {

                //Check if DEMO logo image has been uploaded
                if(!empty($this->request->data['Demo']['logo_upload']['name']))
                {
                    $file = $this->request->data['Demo']['logo_upload']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions

                    //only process if the extension is valid
                    if(in_array($ext, $arr_ext))
                    {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/logos/' . $file['name']);

                        //prepare the filename for database entry
                        $this->request->data['Demo']['logo_upload'] = $file['name'];

                        //link the demo to the new client created
                        $this->request->data['Demo']['client_id'] = $this->Client->id;

                        $this->Client->Demo->create();
                        if ($this->Client->Demo->save($this->request->data)) {

                            foreach ($this->request->data['Step'] as $stepData) {
                                if (!empty($stepData['image_upload']['name'])) {
                                    $file = $stepData['image_upload']; //put the data into a var for easy use

                                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions

                                    //only process if the extension is valid
                                    if (in_array($ext, $arr_ext)) {
                                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                                        //where we are putting it
                                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/demos/' . $file['name']);

                                        //prepare the filename for database entry
                                        $stepData['image_upload'] = $file['name'];

                                        //add the demo id to the step's foreign key.
                                        $stepData['demo_id'] = $this->Client->Demo->id;

                                        $this->Client->Demo->Step->create();
                                        if (!$this->Client->Demo->Step->save($stepData)) {
                                            $this->Session->setFlash(__('The step could not be saved. Please, try again.'));
                                            return $this->redirect(array('action' => 'index'));
                                        }
                                    } else {
                                        $this->Session->setFlash(__('Format not supported for step image. Please, try again.'));
                                    }

                                }
                            }
                        } else {
                            $this->Session->setFlash(__('The demo could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash(__('Format not supported for demo logo. Please, try again.'));
                    }
                }


				$this->Session->setFlash(__('The client and demo have been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('The client has been deleted.'));
		} else {
			$this->Session->setFlash(__('The client could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__('The client has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash(__('The client has been deleted.'));
		} else {
			$this->Session->setFlash(__('The client could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
