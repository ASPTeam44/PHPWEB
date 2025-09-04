CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('buyer','supplier','admin'),
  company_name VARCHAR(150),
  gst_number VARCHAR(50),
  address VARCHAR(255),
  contact VARCHAR(100),
  logo VARCHAR(255)
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  image VARCHAR(255)
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supplier_id INT,
  category_id INT,
  name VARCHAR(150),
  image VARCHAR(255),
  price DECIMAL(10,2),
  moq INT,
  description TEXT,
  approved TINYINT DEFAULT 0,
  FOREIGN KEY (supplier_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE enquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  buyer_id INT,
  supplier_id INT,
  message TEXT,
  created_at DATETIME,
  FOREIGN KEY (product_id) REFERENCES products(id),
  FOREIGN KEY (buyer_id) REFERENCES users(id),
  FOREIGN KEY (supplier_id) REFERENCES users(id)
);

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  enquiry_id INT,
  sender_id INT,
  message TEXT,
  created_at DATETIME,
  FOREIGN KEY (enquiry_id) REFERENCES enquiries(id),
  FOREIGN KEY (sender_id) REFERENCES users(id)
);

INSERT INTO users(name,email,password,role,company_name,gst_number,address,contact,logo) VALUES
('Supplier One','sup1@example.com',PASSWORD('password'),'supplier','Supplier One Pvt Ltd','GSTIN111','Delhi','1234567890','https://via.placeholder.com/100x50?text=Sup1'),
('Supplier Two','sup2@example.com',PASSWORD('password'),'supplier','Supplier Two Pvt Ltd','GSTIN222','Mumbai','1234567891','https://via.placeholder.com/100x50?text=Sup2'),
('Supplier Three','sup3@example.com',PASSWORD('password'),'supplier','Supplier Three Pvt Ltd','GSTIN333','Bengaluru','1234567892','https://via.placeholder.com/100x50?text=Sup3'),
('Supplier Four','sup4@example.com',PASSWORD('password'),'supplier','Supplier Four Pvt Ltd','GSTIN444','Chennai','1234567893','https://via.placeholder.com/100x50?text=Sup4'),
('Buyer One','buyer1@example.com',PASSWORD('password'),'buyer','','','','',''),
('Buyer Two','buyer2@example.com',PASSWORD('password'),'buyer','','','','',''),
('Admin','admin@example.com',PASSWORD('admin123'),'admin','','','','','');

INSERT INTO categories(name,image) VALUES
('Electronics','https://via.placeholder.com/150?text=Electronics'),
('Apparel','https://via.placeholder.com/150?text=Apparel'),
('Machinery','https://via.placeholder.com/150?text=Machinery'),
('Home & Kitchen','https://via.placeholder.com/150?text=Home+Kitchen'),
('Gifts','https://via.placeholder.com/150?text=Gifts'),
('Sports','https://via.placeholder.com/150?text=Sports');

INSERT INTO products(supplier_id,category_id,name,image,price,moq,description,approved) VALUES
(1,1,'Smartphone','https://via.placeholder.com/300?text=Smartphone','200.00',10,'Latest model smartphone',1),
(1,2,'T-Shirt','https://via.placeholder.com/300?text=T-Shirt','5.00',100,'Cotton t-shirt',1),
(2,3,'Drill Machine','https://via.placeholder.com/300?text=Drill','150.00',5,'Powerful drill machine',1),
(2,4,'Mixer Grinder','https://via.placeholder.com/300?text=Mixer','80.00',10,'Durable mixer grinder',1),
(3,5,'Gift Box','https://via.placeholder.com/300?text=Gift+Box','20.00',50,'Decorative gift box',1),
(3,1,'Laptop','https://via.placeholder.com/300?text=Laptop','500.00',5,'Lightweight laptop',1),
(4,2,'Jeans','https://via.placeholder.com/300?text=Jeans','15.00',60,'Denim jeans',1),
(4,6,'Football','https://via.placeholder.com/300?text=Football','25.00',30,'Standard size football',1);
