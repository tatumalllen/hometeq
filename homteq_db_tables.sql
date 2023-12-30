DROP TABLE IF EXISTS Product;
CREATE TABLE Product(
        prodId INT AUTO_INCREMENT,
        prodName VARCHAR(200) NOT NULL,
        prodPicNameSmall VARCHAR(200) NOT NULL,
        prodPicNameLarge VARCHAR(200) NOT NULL,
        prodDescripShort VARCHAR(1000) ,
        prodDescripLong VARCHAR(2000) ,
        prodPrice DECIMAL(8, 2)    NOT NULL DEFAULT '0.00',
        prodQuantity INT    NOT NULL DEFAULT '100',
        CONSTRAINT p_pid_pk PRIMARY KEY(prodID)
);

INSERT INTO Product
(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity)
VALUES
('HIVE Active Heating Thermostat', 'hivesmall.jpg', 'hivebig.jpg', 'Hive Active Heating connects you and your heating system via an app on your mobile device to give you convenient control over operating times from wherever you are.', 'Control heating remotely via the Hive app. Geolocation and app control enable heating alerts and commands to Hive anytime, anywhere.', 149.99, 200);
INSERT INTO Product
(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity)
VALUES
('Amazon Echo Show 5', 'echoshowsmall.jpg', 'echoshowbig.jpg', 'Echo Show connects to Alexa to give you vivid visuals on a 5.5 screen with crisp full sound, all in a compact design that fits in any room, in any home', 'See your day with Alexa at the ready: set alarms and timers, check your calendar or the news, make video calls with the 2 MP camera, and stream music or series—all with your voice.
Add Alexa to your bedside table: ease into the day with a routine that turns compatible lights on. Wake up to your news update, the weather forecast or your favourite music.
Manage your smart home: look in when you''re away with the built-in camera. Control compatible devices like cameras, lights and more using the interactive display or your voice.
Connect with video calling: use the 2 MP camera to call friends and family who have the Alexa app or an Echo device with a screen. Make announcements to other compatible devices in your home.
Be entertained: ask Alexa to play TV programmes and films via Prime Video, Netflix and more. Stream favourites from Amazon Music, Apple Music, Spotify and others.
Put photos on (smart) display: use Amazon Photos or Facebook to turn your Home screen into a digital frame.
Designed to protect your privacy: electronically disconnect the microphones and camera with the press of a button. Slide the built-in cover to close the camera.
', 69.99, 150);
INSERT INTO Product
(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity)
VALUES
    ('LG Smart Fridge', 'lgfridgesmall.jpg', 'lgfridgebig.jpg', '25.5 Cu. Ft. French Door Counter-Depth Smart Refrigerator with InstaView - Stainless steel', '
With Counter-Depth MAX, LG offers the capacity you typically get in a standard-depth refrigerator with the built-in look of a counter-depth. Stock up with room to store it all—then spot what you need in an instant with two quick knocks on the InstaView window. The convenient internal dispenser offers easy access to filtered water while providing a sleek front with no visible dispenser.', 2245.99, 100);
INSERT INTO Product
(prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity)
VALUES
    ('Sengled Bulbs', 'sengledsmall.jpg', 'sengledbig.jpg', 'Smart A19 LED 60W Bulb Bluetooth Mesh Works with Amazon Alexa (4-Pack) - Multicolor', '
Sengled Bluetooth Mesh Smart Bulb that works with Alexa only. Expand your smart home without overcrowding your Wi-Fi network or adding an extra hub, and the Bluetooth Mesh technology allows you to do whole house installation. Simply say "Alexa Discover New Devices" for easy installation, and then use the Alexa app or voice control to setup routines, schedules and away mode. Vibrant color (CRI 90), Ample brightness (800 lumens@2700K).', 29.99, 500);

DROP TABLE IF EXISTS Users;
CREATE TABLE Users(
                        userId INT AUTO_INCREMENT NOT NULL,
                        userType VARCHAR(1) NOT NULL,
                        userFName VARCHAR(100) NOT NULL,
                        userSName VARCHAR(100) NOT NULL,
                        userAddress VARCHAR(200) NOT NULL,
                        userPostCode VARCHAR(20) NOT NULL,
                        userTelNo VARCHAR(20) NOT NULL,
                        userEmail VARCHAR(100) UNIQUE NOT NULL,
                        userPassword VARCHAR(100) NOT NULL,
                        CONSTRAINT p_pid_pk PRIMARY KEY(userID)
);
INSERT INTO Users(userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword);
VALUES(A, Boss, Baby, 190 W Infant Avenue London, UK, EW5 987, +445678910, bossbaby@bigcompany.org, bossy);

INSERT INTO Users(userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword);
VALUES(C, Homer, Simpson, 742 Evergreen Terrace Springfield CA US, 90701, +15557334, chunkylover53@aol.com, donut);

INSERT INTO Users(userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword);
VALUES(C, Minecraft, Steve, 890 W Tundra Grove Overworld, Minecraftia, 230 4389 RTF, +23246097428, steve@minecraft.com, nether);
DROP TABLE IF EXISTS Orders;
CREATE TABLE Orders( orderNo INT AUTO_INCREMENT, userId INT NOT NULL, orderDateTime DATETIME NOT NULL, orderTotal DECIMAL(8,2) NOT NULL DEFAULT '0.0', orderStatus VARCHAR(50) NULL, shippingDate DATE NULL, CONSTRAINT o_ordno_pk PRIMARY KEY (orderNo), CONSTRAINT o_uid_fk FOREIGN KEY (userID) REFERENCES Users (userID) ON DELETE CASCADE );
DROP TABLE IF EXISTS Order_Line;
CREATE TABLE Order_Line(
                           orderLineId INT AUTO_INCREMENT,
                           orderNo INT NOT NULL,
                           prodId INT NOT NULL,
                           quantityOrdered INT  NOT NULL,
                           subTotal DECIMAL(8,2) NOT NULL DEFAULT '0.0',
                           CONSTRAINT o_ordline_pk PRIMARY KEY (orderLineID),
                           CONSTRAINT o_ordno_fk FOREIGN KEY (orderNo) REFERENCES Orders (orderNo) ON DELETE CASCADE,
                           CONSTRAINT o_prodid_fk FOREIGN KEY (prodID) REFERENCES Product (prodId) ON DELETE CASCADE
);
