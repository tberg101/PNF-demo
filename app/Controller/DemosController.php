<?php
App::uses('AppController', 'Controller');
/**
 * Demos Controller
 *
 * @property Demo $Demo
 * @property PaginatorComponent $Paginator
 */
class DemosController extends AppController {

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
		$this->Demo->recursive = 0;
		$this->set('demos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Demo->exists($id)) {
			throw new NotFoundException(__('Invalid demo'));
		}
		$options = array('conditions' => array('Demo.' . $this->Demo->primaryKey => $id));
		$this->set('demo', $this->Demo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
            if(!empty($this->request->data))
            {
                //Check if image has been uploaded
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

                        $this->Demo->create();
                        if ($this->Demo->save($this->request->data)) {

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
                                        $stepData['demo_id'] = $this->Demo->id;

                                        $this->Demo->Step->create();
                                        if (!$this->Demo->Step->save($stepData)) {
                                            $this->Session->setFlash(__('The step could not be saved. Please, try again.'));
                                            return $this->redirect(array('action' => 'index'));
                                        }
                                    } else {
                                        $this->Session->setFlash(__('Format not supported for step image. Please, try again.'));
                                    }

                                }
                            }


                            $this->Session->setFlash(__('The demo has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('The demo could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash(__('Format not supported for demo logo. Please, try again.'));
                    }
                }
            }
		}
		$clients = $this->Demo->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Demo->exists($id)) {
			throw new NotFoundException(__('Invalid demo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Demo->save($this->request->data)) {
				$this->Session->setFlash(__('The demo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The demo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Demo.' . $this->Demo->primaryKey => $id));
			$this->request->data = $this->Demo->find('first', $options);
		}
		$clients = $this->Demo->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * delete method TODO: remove also files on delete
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Demo->id = $id;
		if (!$this->Demo->exists()) {
			throw new NotFoundException(__('Invalid demo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Demo->delete()) {
			$this->Session->setFlash(__('The demo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The demo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Demo->recursive = 0;
		$this->set('demos', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Demo->exists($id)) {
			throw new NotFoundException(__('Invalid demo'));
		}
		$options = array('conditions' => array('Demo.' . $this->Demo->primaryKey => $id));
		$this->set('demo', $this->Demo->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Demo->create();
			if ($this->Demo->save($this->request->data)) {
				$this->Session->setFlash(__('The demo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The demo could not be saved. Please, try again.'));
			}
		}
		$clients = $this->Demo->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Demo->exists($id)) {
			throw new NotFoundException(__('Invalid demo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Demo->save($this->request->data)) {
				$this->Session->setFlash(__('The demo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The demo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Demo.' . $this->Demo->primaryKey => $id));
			$this->request->data = $this->Demo->find('first', $options);
		}
		$clients = $this->Demo->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * admin_delete method TODO: remove also files on delete
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Demo->id = $id;
		if (!$this->Demo->exists()) {
			throw new NotFoundException(__('Invalid demo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Demo->delete()) {
			$this->Session->setFlash(__('The demo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The demo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
