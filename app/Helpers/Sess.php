<?php
  function set($array)
  {
    session($array);
  }
  function get($data)
  {
    return session()->get($data);
  }
  function verify($var,$id)
  {
    if (session()->get($var) == $id) {
      return true;
    }else {
      return false;
    }
  }
  function destroy()
  {
    session()->flush();
  }

 ?>
