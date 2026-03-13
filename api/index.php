<?php

// Forward Vercel requests to the normal Laravel public/index.php
// This allows Vercel's serverless PHP runtime to execute Laravel.
require __DIR__ . '/../public/index.php';
