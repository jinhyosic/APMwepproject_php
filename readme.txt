-Version
	Apache 2.4.57 (Win64)
	PHP 8.2.5

-mySQL
	schema : wepproject
	table : member, board
		-member
			id varchar(45) PK 
			pw varchar(45) 
			hp varchar(45)
		-board
			idx int AI PK 
			id varchar(50) 
			subject varchar(100) 
			shop_name varchar(50) 
			shop_address varchar(60) 
			short_review varchar(60) 
			category varchar(45) 
			content varchar(1000) 
			date varchar(30) 
			img varchar(100) 
			hit int default 0