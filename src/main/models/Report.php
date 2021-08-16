<?php

class Report
{
    private $Time;
    private $Week;
    private $Edit;
    private $Comment;

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * @param mixed $Time
     */
    public function setTime($Time): void
    {
        $this->Time = $Time;
    }

    /**
     * @return mixed
     */
    public function getWeek()
    {
        return $this->Week;
    }

    /**
     * @param mixed $Week
     */
    public function setWeek($Week): void
    {
        $this->Week = $Week;
    }

    /**
     * @return mixed
     */
    public function getEdit()
    {
        return $this->Edit;
    }

    /**
     * @param mixed $Edit
     */
    public function setEdit($Edit): void
    {
        $this->Edit = $Edit;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->Comment;
    }

    /**
     * @param mixed $Comment
     */
    public function setComment($Comment): void
    {
        $this->Comment = $Comment;
    }

}