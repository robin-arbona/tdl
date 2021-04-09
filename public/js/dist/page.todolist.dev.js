"use strict";

var initTodoList = function initTodoList() {
  console.log('hello todo list');
  addForm = document.querySelector('.task_add');
  todolist = document.querySelector('.task_todo');
  doneList = document.querySelector('.task_done');
  serverMsg = document.querySelector('.server_msg');
  init();

  function init() {
    return regeneratorRuntime.async(function init$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return regeneratorRuntime.awrap(fetch('base_url').then(function (reponse) {
              return reponse.text();
            }));

          case 2:
            BASE_URL = _context.sent;
            initTask();
            initAddTaskButton();

          case 5:
          case "end":
            return _context.stop();
        }
      }
    });
  }

  function initTask() {
    tasks = document.querySelectorAll('.task');
    tasks.forEach(function (task) {
      task.addEventListener('click', function _callee(e) {
        return regeneratorRuntime.async(function _callee$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                e.preventDefault();
                postAndRefresh(this.parentElement, 'Task/update/changeState');

              case 2:
              case "end":
                return _context2.stop();
            }
          }
        }, null, this);
      });
    });
  }

  function initAddTaskButton() {
    addBtn = document.querySelector('.task_add > input[type=submit]');
    addBtn.addEventListener('click', function _callee2(e) {
      return regeneratorRuntime.async(function _callee2$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              e.preventDefault();
              postAndRefresh(addForm, 'Task/add');

            case 2:
            case "end":
              return _context3.stop();
          }
        }
      });
    });
  }

  function postAndRefresh(formElement, action) {
    var response, jsonContent, msg;
    return regeneratorRuntime.async(function postAndRefresh$(_context4) {
      while (1) {
        switch (_context4.prev = _context4.next) {
          case 0:
            _context4.next = 2;
            return regeneratorRuntime.awrap(post(action, new FormData(formElement)));

          case 2:
            response = _context4.sent;
            _context4.next = 5;
            return regeneratorRuntime.awrap(response.json());

          case 5:
            jsonContent = _context4.sent;
            msg = jsonContent.msg;

            if (!(response.status == 201)) {
              _context4.next = 16;
              break;
            }

            _context4.next = 10;
            return regeneratorRuntime.awrap(refreshComponent('Task/todo', todolist));

          case 10:
            _context4.next = 12;
            return regeneratorRuntime.awrap(refreshComponent('Task/done', doneList));

          case 12:
            initTask();
            msg = '<div class="notification is-success"><button class="delete"></button>' + msg + '</div>';
            _context4.next = 17;
            break;

          case 16:
            msg = '<div class="notification is-warning"><button class="delete"></button>' + msg + '</div>';

          case 17:
            displayMessage(msg);

          case 18:
          case "end":
            return _context4.stop();
        }
      }
    });
  }

  function refreshComponent($url, $component) {
    return regeneratorRuntime.async(function refreshComponent$(_context5) {
      while (1) {
        switch (_context5.prev = _context5.next) {
          case 0:
            _context5.next = 2;
            return regeneratorRuntime.awrap(get($url));

          case 2:
            $component.innerHTML = _context5.sent;

          case 3:
          case "end":
            return _context5.stop();
        }
      }
    });
  }

  function displayMessage($msg) {
    serverMsg.innerHTML = $msg + serverMsg.innerHTML;
  }

  function get(url) {
    return regeneratorRuntime.async(function get$(_context6) {
      while (1) {
        switch (_context6.prev = _context6.next) {
          case 0:
            return _context6.abrupt("return", fetch(url).then(function (response) {
              return response.text();
            }));

          case 1:
          case "end":
            return _context6.stop();
        }
      }
    });
  }

  function post(url, data) {
    return regeneratorRuntime.async(function post$(_context7) {
      while (1) {
        switch (_context7.prev = _context7.next) {
          case 0:
            return _context7.abrupt("return", fetch(url, {
              method: 'POST',
              body: data
            }).then(function (response) {
              return response;
            }));

          case 1:
          case "end":
            return _context7.stop();
        }
      }
    });
  }
};

initTodoList();