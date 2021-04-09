"use strict";

var formPH;
var serverMsg;
var BASE_URL;
document.addEventListener('DOMContentLoaded', function _callee() {
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          _context.next = 2;
          return regeneratorRuntime.awrap(fetch('base_url').then(function (reponse) {
            return reponse.text();
          }));

        case 2:
          BASE_URL = _context.sent;
          formPH = document.querySelector('.form');
          serverMsg = document.querySelector('.server_msg');
          init();

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
});

function init() {
  return regeneratorRuntime.async(function init$(_context2) {
    while (1) {
      switch (_context2.prev = _context2.next) {
        case 0:
          loadConnexionForm();

        case 1:
        case "end":
          return _context2.stop();
      }
    }
  });
}

function loadConnexionForm() {
  return regeneratorRuntime.async(function loadConnexionForm$(_context4) {
    while (1) {
      switch (_context4.prev = _context4.next) {
        case 0:
          _context4.next = 2;
          return regeneratorRuntime.awrap(loadContent(BASE_URL + '/view/component/connexion_form.php'));

        case 2:
          formPH.innerHTML = _context4.sent;
          document.querySelector('a[href="#inscription"]').addEventListener('click', function _callee2(e) {
            return regeneratorRuntime.async(function _callee2$(_context3) {
              while (1) {
                switch (_context3.prev = _context3.next) {
                  case 0:
                    e.preventDefault();
                    _context3.next = 3;
                    return regeneratorRuntime.awrap(loadInscriptionForm());

                  case 3:
                  case "end":
                    return _context3.stop();
                }
              }
            });
          });
          handleForm('user/connexion', function () {
            return changePage('Task/dashboard', 'todolist');
          });

        case 5:
        case "end":
          return _context4.stop();
      }
    }
  });
}

function loadInscriptionForm() {
  return regeneratorRuntime.async(function loadInscriptionForm$(_context5) {
    while (1) {
      switch (_context5.prev = _context5.next) {
        case 0:
          _context5.next = 2;
          return regeneratorRuntime.awrap(loadContent('view/component/inscription_form.php'));

        case 2:
          formPH.innerHTML = _context5.sent;
          handleForm('user/add', loadConnexionForm);

        case 4:
        case "end":
          return _context5.stop();
      }
    }
  });
}

function handleForm(action, callback) {
  document.querySelector('#submit').addEventListener('click', function _callee3(e) {
    var response, jsonContent, msg;
    return regeneratorRuntime.async(function _callee3$(_context6) {
      while (1) {
        switch (_context6.prev = _context6.next) {
          case 0:
            e.preventDefault();
            data = new FormData(document.querySelector('form'));
            _context6.next = 4;
            return regeneratorRuntime.awrap(postContent(action, data));

          case 4:
            response = _context6.sent;
            _context6.next = 7;
            return regeneratorRuntime.awrap(response.json());

          case 7:
            jsonContent = _context6.sent;
            msg = jsonContent.msg;

            if (response.status == 201) {
              callback();
              msg = '<div class="notification is-success"><button class="delete"></button>' + msg + '</div>';
            } else {
              msg = '<div class="notification is-warning"><button class="delete"></button>' + msg + '</div>';
            }

            displayMessage(msg);

          case 11:
          case "end":
            return _context6.stop();
        }
      }
    });
  });
}

function displayMessage($msg) {
  serverMsg.innerHTML = $msg;
}

function loadContent(url) {
  return regeneratorRuntime.async(function loadContent$(_context7) {
    while (1) {
      switch (_context7.prev = _context7.next) {
        case 0:
          return _context7.abrupt("return", fetch(url).then(function (response) {
            return response.text();
          }));

        case 1:
        case "end":
          return _context7.stop();
      }
    }
  });
}

function postContent(url, data) {
  return regeneratorRuntime.async(function postContent$(_context8) {
    while (1) {
      switch (_context8.prev = _context8.next) {
        case 0:
          return _context8.abrupt("return", fetch(url, {
            method: 'POST',
            body: data
          }).then(function (response) {
            return response;
          }));

        case 1:
        case "end":
          return _context8.stop();
      }
    }
  });
}

function changePage(page, scriptName) {
  var content;
  return regeneratorRuntime.async(function changePage$(_context9) {
    while (1) {
      switch (_context9.prev = _context9.next) {
        case 0:
          _context9.next = 2;
          return regeneratorRuntime.awrap(fetch(page).then(function (response) {
            return response.text();
          }));

        case 2:
          content = _context9.sent;
          document.querySelector('.page_content').innerHTML = content;
          document.querySelector('script').remove();
          script = document.createElement('script');
          script.type = 'text/javascript';
          script.src = BASE_URL + '/public/js/page.' + scriptName + '.js';
          document.querySelector(".script").appendChild(script);

        case 9:
        case "end":
          return _context9.stop();
      }
    }
  });
}