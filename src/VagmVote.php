<?php

namespace Ince\VAGM;

trait VagmVote
{
    /**
     * Get all votes.
     *
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getAllVotes()
    {
        return $this->get('/api/votes');
    }

    /**
     * Get discretion votes.
     *
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getDiscretionVotes()
    {
        return $this->get('/api/votes/discretion');
    }

    /**
     * Submit a single OTD discretionary vote.
     *
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function otdDiscVote(array $data)
    {
        return $this->post('/api/votes/otd/single/discretionary', $data);
    }

    /**
     * Submit all OTD discretionary votes.
     *
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function otdDiscVotes(array $data)
    {
        return $this->post('/api/votes/otd/all/discretionary', $data);
    }

    /**
     * Submit a single OTD normal vote.
     *
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function otdVote(array $data)
    {
        return $this->post('/api/votes/otd/single', $data);
    }

    /**
     * Submit all OTD normal votes.
     *
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function otdVotes(array $data)
    {
        return $this->post('/api/votes/otd/all', $data);
    }

    /**
     * Submit all proxy votes.
     *
     * @param  array  $data
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function proxyVotes(array $data)
    {
        return $this->post('/api/votes/proxy/all', $data);
    }
}