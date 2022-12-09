CREATE TABLE IF NOT EXISTS todos (
	                                 id  varchar(32) primary key,
	                                 title varchar(512),
	                                 completed varchar(1) not null default 'N',
	                                 created_at datetime not null default CURRENT_TIMESTAMP,
	                                 updated_at datetime default null,
	                                 completed_at datetime default null
);

INSERT INTO todos (id, title) VALUE ('qcoa49vjd', 'Test task');