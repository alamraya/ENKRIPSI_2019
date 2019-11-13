const express = require("express");
const bodyParser = require("body-parser");
const path = require("path");
const app = express();

app.set("view engine", "ejs");
// app.use(express.static(path.join(__dirname, "/public")));
app.use(bodyParser.urlencoded({ extended: true }));

const mode = "caesar";
const encrypt = (text, shift) => {
  var result = "";
  if (mode == "caesar") {
    for (let i = 0; i < text.length; i++) {
      var c = text.charCodeAt(i);
      if (c >= 65 && c <= 90) {
        result += String.fromCharCode(((c - 65 + shift) % 26) + 65);

        // handle lowercase letters
      } else if (c >= 97 && c <= 122) {
        result += String.fromCharCode(((c - 97 + shift) % 26) + 97);

        // its not a letter, let it through
      } else {
        result += text.charAt(i);
      }
    }
  }
  return result;
};

const decrypt = (text, shift) => {
  var result = "";
  shift = (26 - shift) % 26;
  result = encrypt(text, shift);
  return result;
};

app.get("/", (req, res) => {
  var data = {
    encrypt: "",
    decrypt: ""
  };
  res.render(__dirname + "/public/index.ejs", { data });
});

app.post("/", (req, res) => {
  if (req.body.submit == "encrypt") {
    var key = req.body.encrypt_key * 1;
    data = {
      encrypt: encrypt(req.body.encrypt_string, key),
      decrypt: ""
    };
  } else if (req.body.submit == "decrypt") {
    var key = req.body.decrypt_key * 1;
    data = {
      encrypt: "",
      decrypt: decrypt(req.body.decrypt_string, key)
    };
  } else {
    data = {
      encrypt: "",
      decrypt: ""
    };
  }

  res.render(__dirname + "/public/index.ejs", { data });
});

app.listen(8080, "");
console.log("app listen on port 8080");
