<?php
namespace DataStorage;

interface iDataProcessor {
    public function Encode($data);
    public function Decode($data);
}