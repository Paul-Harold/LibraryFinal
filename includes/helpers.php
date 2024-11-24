<?php

function current_user()
{
  if (is_user_logged_in()) {
    return $_SESSION['username'];
  }
  return null;
}

function is_user_logged_in(): bool
{
  return isset($_SESSION['username']);
}

function redirect_to(string $url): void
{
  header('Location:' . $url);
  exit;
}
