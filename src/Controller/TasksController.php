<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\DateTime;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */



    public function index()
    {
        $userId = $this->Authentication->getIdentity()->getIdentifier();
        $query = $this->Tasks->find()
            ->contain(['Users'])->where(['user_id' => $userId])->orderByAsc('begin');
        $tasks = $this->paginate($query);

        $this->set(compact('tasks'));
    }

    public function weekly()
    {
        $userId = $this->Authentication->getIdentity()->getIdentifier();
        $startOfWeek = $this->request->getQuery('week', DateTime::now()->startOfWeek());
        $startOfWeek = new DateTime($startOfWeek);
        $endOfWeek = $startOfWeek->endOfWeek();;
        $query = $this->Tasks->find()
            ->contain(['Users'])
            ->where(['user_id' => $userId, ["OR" => [['begin  >=' => $startOfWeek->format("Y-m-d 00:00:00"), 'begin <=' => $endOfWeek], ['end  >=' => $startOfWeek->format("Y-m-d 00:00:00"), 'end <=' => $endOfWeek]]]])->orderByAsc('begin');

        $tasks = $this->paginate($query);
        $week = $startOfWeek;
        $this->set(compact('tasks', 'week'));
    }

    public function monthly()
    {
        $userId = $this->Authentication->getIdentity()->getIdentifier();
        $startOfMonth = $this->request->getQuery('month', DateTime::now()->startOfMonth());
        $startOfMonth = new DateTime($startOfMonth);
        $endOfMonth = $startOfMonth->endOfMonth();;
        $query = $this->Tasks->find()
            ->contain(['Users'])
            ->where(['user_id' => $userId, ["OR" => [['begin  >=' => $startOfMonth->format("Y-m-d 00:00:00"), 'begin <=' => $endOfMonth], ['end  >=' => $startOfMonth->format("Y-m-d 00:00:00"), 'end <=' => $endOfMonth]]]])->orderByAsc('begin');

        $tasks = $this->paginate($query);
        $month = $startOfMonth;
        $this->set(compact('tasks', 'month'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, contain: ['Users']);
        $this->set(compact('task'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $userId = $this->Authentication->getIdentity()->getIdentifier();
        $user = $this->Tasks->Users->find(limit: 200)->where(["id" => $userId])->first();
        // $users = $this->Tasks->Users->find('list', limit: 200)->all();
        $this->set(compact('task', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $users = $this->Tasks->Users->find('list', limit: 200)->all();
        $this->set(compact('task', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
