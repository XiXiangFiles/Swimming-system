let mysql  = require('mysql');
let SerialPort = require('serialport');
let dppool = mysql.createPool({
    host     : 'localhost',
    user     : 'test',
    password : 'test',
    database : 'test'
    });
let serialport = new SerialPort('/dev/cu.usbmodem1421', function (err) {
	if (err) {
    	return console.log('Error: ', err.message);
  	}
});
serialport.on('open', function(){
  console.log('Serial Port Opend');
  serialport.on('data', function(data){
      console.log(data[0]);

      if(data[0] > 0){ //假如從arduino序列埠收到訊號
      	var userName = 'user001';
      	let query = "INSERT INTO ?? (??)  VALUES (?)";
      	let table = ["swim","user", userName]
      	query = mysql.format(query,table);
      	dppool.query(query,function(err,rows){
        //console.log(rows.changedRows);
        if(err) {
            console.log(err);
        }
    });
   }
  });
});