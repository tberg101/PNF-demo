<?php
App::uses('AppController', 'Controller');
/**
 * Steps Controller
 *
 * @property Step $Step
 * @property PaginatorComponent $Paginator
 */
class StepsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($demo_name = null, $offset = null) {
        $this->layout = 'client_step';
        $demo_name = urldecode($demo_name);
        $options = array('conditions' => array('Demo.name' => $demo_name));
        $selectedDemo = $this->Step->Demo->find('first', $options);
        if (!$selectedDemo) {
            throw new NotFoundException(__('Invalid Demo'));
        }
        $options = array('conditions' => array('Step.demo_id' => $selectedDemo['Demo']['id']));
        $steps = $this->Step->find('all', $options);
        if (!$steps[$offset]) {
            throw new NotFoundException(__('Invalid Step'));
        }
        $this->set('step', $steps[$offset]);
        $this->set('demo', $selectedDemo);
        $this->set('next_offset', ($offset+1)%count($selectedDemo['Step']));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Step->recursive = 0;
        $this->set('steps', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($demo_name = null, $offset = null) {
        $demo_name = urldecode($demo_name);
        $options = array('conditions' => array('Demo.name' => $demo_name));
        $selectedDemo = $this->Step->Demo->find('first', $options);
        if (!$selectedDemo) {
            throw new NotFoundException(__('Invalid Demo'));
        }
        $options = array('conditions' => array('Step.demo_id' => $selectedDemo['Demo']['id']));
        $steps = $this->Step->find('all', $options);
        if (!$steps[$offset]) {
            throw new NotFoundException(__('Invalid Step'));
        }
        $this->set('step', $steps[$offset]);
        $this->set('demo', $selectedDemo);
        $this->set('next_offset', ($offset+1)%count($selectedDemo['Step']));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data)) {
                //Check if image has been uploaded
                if (!empty($this->request->data['Step']['image_upload']['name'])) {
                    $file = $this->request->data['Step']['image_upload']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/demos/' . $file['name']);

                        //prepare the filename for database entry
                        $this->request->data['Step']['image_upload'] = $file['name'];

                        $this->Step->create();
                        if ($this->Step->save($this->request->data)) {
                            $this->Session->setFlash(__('The step has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('The step could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash(__('Format not supported. Please, try again.'));
                    }

                }
            }
        }
        $demos = $this->Step->Demo->find('list');
        $this->set(compact('demos'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
		if (!$this->Step->exists($id)) {
			throw new NotFoundException(__('Invalid step'));
		}
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data)) {
                //Check if image has been uploaded
                if (!empty($this->request->data['Step']['image_upload']['name'])) {
                    $file = $this->request->data['Step']['image_upload']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/demos/' . $file['name']);

                        //prepare the filename for database entry
                        $this->request->data['Step']['image_upload'] = $file['name'];

                        $this->Step->create();
                        if ($this->Step->save($this->request->data)) {
                            $this->Session->setFlash(__('The step has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('The step could not be saved. Please, try again.'));
                        }
                    } else {
                        $this->Session->setFlash(__('Format not supported. Please, try again.'));
                    }

                }
            }
        } else {
			$options = array('conditions' => array('Step.' . $this->Step->primaryKey => $id));
			$this->request->data = $this->Step->find('first', $options);
		}
        $demos = $this->Step->Demo->find('list');
        $this->set(compact('demos'));
	}

/**
 * admin_delete method TODO: remove also files on delete
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Step->id = $id;
		if (!$this->Step->exists()) {
			throw new NotFoundException(__('Invalid step'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Step->delete()) {
			$this->Session->setFlash(__('The step has been deleted.'));
		} else {
			$this->Session->setFlash(__('The step could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * ajax_savecoords method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function ajax_savecoords() {
        $this->autoLayout = false;
        $this->autoRender = false;
        $this->layout = 'ajax';

        $step_id = $this->request->data['id'];
        $newCoords = $this->request->data['coords'];

        $this->Step->id = $step_id;
        if (!$this->Step->exists()) {
            throw new NotFoundException(__('Invalid step'));
        }
        $this->Step->saveField('area_coords',$newCoords);

        print json_encode(true);
	}
}