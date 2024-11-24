<?php

require_once 'helpers.php';
require_once 'bootstrap.php';


function find_user_by_username(string $username)
{
  $sql = 'SELECT username, password
            FROM users
            WHERE username=:username';

  $statement = db()->prepare($sql);
  $statement->bindValue(':username', $username);
  $statement->execute();

  return $statement->fetch(PDO::FETCH_ASSOC);
}

function login(string $username, string $password): bool
{
  $user = find_user_by_username($username);

  // if user found, check the password
  if ($user && password_verify($password, $user['password'])) {

    // prevent session fixation attack
    session_regenerate_id();

    // set username in the session
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];

    return true;
  }
  return false;
}


function register_user(string $username, string $password, string $email, string $firstName, string $lastName): bool
{
  $sql = 'INSERT INTO users(username, firstname, lastname, email, password)
            VALUES(:username, :firstname, :lastname, :email, :password)';

  $statement = db()->prepare($sql);

  $statement->bindValue(':username', $username);
  $statement->bindValue(':firstname', $firstName);
  $statement->bindValue(':lastname', $lastName);
  $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
  $statement->bindValue(':email', $email);

  return $statement->execute();
}


