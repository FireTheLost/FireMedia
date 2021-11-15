CREATE TABLE blogmeta
(
    blogmetaId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    blogmetaLikes int(16) NOT NULL,
    blogmetaDislikes int(16) NOT NULL,
    blogmetaRandomKey varchar(16) NOT NULL
);

CREATE TABLE likes
(
    likesId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    likesUser varchar(128) NOT NULL,
    likesBlog varchar(16) NOT NULL
);

CREATE TABLE blogs
(
    blogsId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    blogTitle varchar(256) NOT NULL,
    blogBody text NOT NULL,
    blogAuthor varchar(128) NOT NULL,
    blogDate varchar(32) NOT NULL,
    blogDescription varchar(64) NOT NULL,
    blogViews int(16) NOT NULL,
    blogRandomKey varchar(16) NOT NULL
);

CREATE TABLE reports
(
    reportsId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    reportsBlog varchar(16) NOT NULL,
    reportsReason varchar(256) NOT NULL,
    reportsComment varchar(256) NOT NULL,
    reportsUser varchar(128) NOT NULL
);

ALTER TABLE blogmeta
ADD COLUMN blogmetaReported int(16) DEFAULT 0;

CREATE TABLE viewscounter
(
    viewscounterId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    viewscounterUser varchar(128) NOT NULL,
    viewscounterBlog varchar(16)
);

CREATE TABLE users
(
    usersId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usersName varchar(128) NOT NULL,
    usersemail varchar(128) NOT NULL,
    usersUid varchar(128) NOT NULL,
    usersPwd varchar(128) NOT NULL,
    usersJoined varchar(32) NOT NULL,
    usersAbout varchar(512) NOT NULL DEFAULT "Hello, I haven't updated this yet but I will soon."
);

CREATE TABLE files
(
    filesId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    filesTitle varchar(256) NOT NULL,
    filesDescription varchar(64) NOT NULL,
    filesAuthor varchar(128) NOT NULL,
    filesDate varchar(32) NOT NULL,
    filesViews int(16) NOT NULL,
    filesRandomKey varchar(16) NOT NULL,
    filesName varchar(128) Not NULL,
    filesType varchar(8) NOT NULL
);

ALTER TABLE likes
ADD COLUMN likesType varchar(16);

CREATE TABLE filesViewscounter
(
    filesViewscounterId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    filesViewscounterUser varchar(128) NOT NULL,
    filesViewscounterFile varchar(16)
);

CREATE TABLE fileslikes
(
    fileslikesId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    fileslikesUser varchar(128) NOT NULL,
    fileslikesFile varchar(16) NOT NULL
);

ALTER TABLE fileslikes
ADD COLUMN fileslikesType varchar(16);

CREATE TABLE filesmeta
(
    filesmetaId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    filesmetaLikes int(16) NOT NULL,
    filesmetaDislikes int(16) NOT NULL,
    filesmetaRandomKey varchar(16) NOT NULL
);

ALTER TABLE filesmeta
ADD COLUMN filesmetaReported int(16) DEFAULT 0;

CREATE TABLE filesreports
(
    filesreportsId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    filesreportsFile varchar(16) NOT NULL,
    filesreportsReason varchar(256) NOT NULL,
    filesreportsComment varchar(256) NOT NULL,
    filesreportsUser varchar(128) NOT NULL
);

ALTER TABLE users
ADD COLUMN usersPlan varchar(16) DEFAULT "Free Plan";

CREATE TABLE filesComments
(
    filesCommentsId int(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    filesCommentsRandomKey varchar(32) NOT NULL,
    filesCommentsAuthor varchar(128) NOT NULL,
    filesCommentsMessage text NOT NULL,
    filesCommentsFile varchar(16) NOT NULL,
    filesCommentsDate varchar(32) NOT NULL
);

ALTER TABLE filesComments
ADD COLUMN filesCommentsLikes int(8) DEFAULT 1;

CREATE TABLE filescommentslikes
(
    filescommentslikesId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    filescommentslikesUser varchar(128) NOT NULL,
    filescommentslikesFile varchar(16) NOT NULL
);

ALTER TABLE filescommentslikes
ADD COLUMN filescommentslikesType varchar(16);

ALTER TABLE filescommentslikes
ADD COLUMN filescommentslikesRandomKey varchar(32);

CREATE TABLE comments
(
    commentsId int(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    commentsRandomKey varchar(32) NOT NULL,
    commentsAuthor varchar(128) NOT NULL,
    commentsMessage text NOT NULL,
    commentsFile varchar(16) NOT NULL,
    commentsDate varchar(32) NOT NULL
);

ALTER TABLE comments
ADD COLUMN commentsLikes int(8) DEFAULT 1;

CREATE TABLE commentslikes
(
    commentslikesId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    commentslikesUser varchar(128) NOT NULL,
    commentslikesFile varchar(16) NOT NULL
);

ALTER TABLE commentslikes
ADD COLUMN commentslikesType varchar(16);

ALTER TABLE commentslikes
ADD COLUMN commentslikesRandomKey varchar(32);

ALTER TABLE users
ADD COLUMN usersRandomKey varchar(32);

ALTER TABLE filesmeta
ADD COLUMN filesmetaType varchar(8) NOT NULL;

CREATE TABLE usersmessages
(
    usersmessagesId int(16) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usersmessagesMessage text NOT NULL,
    usersmessagesFrom varchar(128) NOT NULL,
    usersmessagesTo varchar(128) NOT NULL
);

ALTER TABLE files
ADD COLUMN filesVisibility varchar(16) NOT NULL DEFAULT 'Visible';

ALTER TABLE blogs
ADD COLUMN blogsVisibility varchar(16) NOT NULL DEFAULT 'Visible';

ALTER TABLE usersmessages
ADD usersmessagesStatus varchar(16);