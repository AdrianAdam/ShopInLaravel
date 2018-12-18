A web store with some products, where only users that are logged in can buy. Made with Laravel and MySQL.

MySQL table structures: Users: the default one from Laravel. Products: name varchar(20), price int(5), quantity int(2), ipProd int(2) (product), inProduc int(2) (producer). Producer: nameProducer varchar(20), address varchar(20), idProducer int(2). Favourites: idUser int(2), idProductFav int(2), quantityFav int(2). Shopping Cart: idUser int(2), idProductSC int(2), quantity int(2). Orders: idOrder int(2), idProductOrder int(2), idUserOrder int(2), quantityOrder int(3).

The user is connected with the favourites and shopping cart tables with idUser. These two tables are connected with the products: idProductFav / idProductSC with idProd. The product table is connected with producer table: idProduc with idProducer.

Notes: you will have to make changes in the php files of my project where I take data from MySQL. For exemple, I used 'produse' to name the product table. If you want to name your table 'product' change the query from DB::table('produse') to DB::table('product'). The same applies for the other tables, database columns etc.

You can see pictures of the website in the final results folder.
