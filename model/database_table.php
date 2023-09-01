<?php

require_once 'connection.php';

class table extends Database
{
      public function createTable()
      {
            $conn=$this->connection;

// $sql = "create table if not exists user (
//       id int(5) unsigned auto_increment primary key,
//       role varchar(100),
//       image varchar(100),
//       fullname tinytext,
//       email varchar(100) unique,
//       mob int(10),
//       dob date,
//       address longtext,
//       gender enum('m','f','o'),
//       hobbies varchar(100),
//       password varchar(100)
//       )";

// $sql = "create table if not exists courses (
      
//       id int(5) unsigned auto_increment primary key,
//       teacher_id int(5) unsigned,
//       coursename varchar(100),
//       price int(10),
//       image varchar(100),
//       foreign key(teacher_id) references user(id) on delete cascade on update cascade
//       )";

// $sql = "create table if not exists enrolled (
//       id int(5) unsigned auto_increment primary key,
//       student_id int(5) unsigned,
//       course_id int(5) unsigned,
//       foreign key(student_id) references user(id) on delete cascade on update cascade,
//       foreign key(course_id) references courses(id) on delete cascade on update cascade,
//       unique(student_id,course_id)
      
//       )";

// $sql = "create table if not exists comments (
//           id int(5) unsigned auto_increment primary key,
//           user_id int(5) unsigned,
//           course_id int(5) unsigned,
//           comment longtext,
//           foreign key(course_id) references enrolled(course_id) on delete cascade on update cascade
//         )";]

// $sql = "create table if not exists notice (
//             id int(5) unsigned auto_increment primary key,
//             subject varchar(100),
//             detail varchar(200),
//             course_id int(5) unsigned,
//             foreign key(course_id) references courses(id) on delete cascade on update cascade
        
//         )";

// $sql = "create table if not exists payment
// (
//   id int(5) unsigned auto_increment primary key,
//   student_id int(5) unsigned,
//   course_id int(5) unsigned,
//   card_number bigint(16) unsigned,
//   cvv int(3) unsigned,
//   exp_date date,
//   amount int(5) unsigned,
//   pdf varchar(100),
//   created_at datetime default current_timestamp,
//   status enum('a','p','r') default 'p',
//   foreign key(student_id) references user(id) on delete cascade on update cascade,
//   foreign key(course_id) references courses(id) on delete cascade on update cascade
//   )";
// $sql = "alter table payment add unique key(student_id,course_id)";

$sql = "create table if not exists course_progress
(
      id int(5) unsigned auto_increment primary key,
      student_id int(5) unsigned,
      course_id int(5) unsigned,
      progress int(3) unsigned,
      certificate varchar(100),
      updated_at timestamp default current_timestamp on update current_timestamp,
      foreign key(student_id) references payment(student_id) on delete cascade on update cascade,
      foreign key(course_id) references payment(course_id) on delete cascade on update cascade,
      unique key(student_id,course_id)
)";

      if($conn->query($sql))
      {
            echo "table created";
      }
      else
      {
            echo $conn->error;
      }
}
}

$db_table = new Table();

$db_table->createTable()



?>