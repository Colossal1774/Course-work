<?php
use App\User;

 class UserClassTest extends PHPUnit\Framework\TestCase{
  public function testAuthorizationFalse(){
    $_19327_false = $this->createMock(App\User::class);
    $_19327_false->method("authenticate")->willReturn(false);
    $this->assertFalse($_19327_false->authenticate(""));
  }

  public function testAuthorizationTrue(){
    $_19327 = $this->createMock(App\User::class);
    $_19327->method("authenticate")->willReturn(true);
    $this->assertTrue($_19327->authenticate(""));
  }
 
 public function testisLocked(){
    $user = new App\User("xd",123);
    $user->lock_user();
    $this->assertFalse($user->is_locked());
 }
 public function testisUnlocked(){
  $user = new App\User("xd",123);
  $user->unlock_user();
  $this->assertTrue($user->is_locked());
}
public function testPasswordReset(){
  $user = new App\User("xd","1234");
  $user->reset_password("1234");
  $this->assertEquals("1234",$user->password);
}

public function testMockObjectThrowsExceptionForCourseNumber(){
  $mockUser = $this->getMockBuilder(App\User::class)
                  ->disableOriginalConstructor()
                  ->getMock();

  $mockUser->expects($this->any())
          ->method("authenticate")
          ->will($this->returnCallback(function($password){
            if ($password === "19327"){
              throw new Exception ("Invalid course number");
            }
            return false;
          }));
          $this->expectException(Exception::class);
          $mockUser->authenticate("19327");
}


public function testMockObjectReturnsFalseForOtherPasswords(){
  $mockUser = $this->getMockBuilder(App\User::class)
                  ->disableOriginalConstructor()
                  ->getMock();

  $mockUser->expects($this->any())
          ->method("authenticate")
          ->will($this->returnCallback(function($password){
            if ($password === "19327"){
              throw new Exception ("Invalid course number");
            }
            return false;
          }));
          $this->assertFalse($mockUser->authenticate("1234"));
}
}