<?php

namespace Ince\VAGM;

trait VagmEvents
{
    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getPublicEvents()
    {
        return $this->get('/api/guest/events');
    }

    /**
     * @param  string  $uuid
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getPublicEvent(string $uuid)
    {
        return $this->get(sprintf('/api/guest/events/%s', $uuid));
    }

    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getEvent()
    {
        return $this->get('/api/events/event');
    }

    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getResults()
    {
        return $this->get('/api/events/results');
    }

    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getReport()
    {
        return $this->get('/api/events/report');
    }

    /**
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function updateEvent(array $data)
    {
        return $this->put('/api/events/event', $data);
    }

    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function activeUsers()
    {
        return $this->get('/api/events/users-active');
    }

    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getAnswers()
    {
        return $this->get('/api/events/answers');
    }

    /**
     * @param  array  $form
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function submitAnswer(array $form)
    {
        return $this->post('/api/events/answer', $form);
    }

    /**
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getQuestions()
    {
        return $this->get('/api/events/questions');
    }

    /**
     * @param  array  $form
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function submitQuestion(array $form)
    {
        return $this->post('/api/events/question', $form);
    }
}