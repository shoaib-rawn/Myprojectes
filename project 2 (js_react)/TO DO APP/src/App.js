import React, { useState } from 'react';

function App() {
  const [tasks, setTasks] = useState([]);
  const [editingId, setEditingId] = useState(null);
  const [editingText, setEditingText] = useState('');

  const handleAddTask = () => {
    // Create a new task with empty text and set it to editing mode
    const newTask = { id: Date.now(), text: '' };
    setTasks([...tasks, newTask]);
    setEditingId(newTask.id);
    setEditingText('');
  };

  const handleDeleteTask = (id) => {
    setTasks(tasks.filter(task => task.id !== id));
    if (editingId === id) {
      setEditingId(null);
      setEditingText('');
    }
  };

  const handleEditChange = (e) => {
    setEditingText(e.target.value);
  };

  const handleSaveTask = (id) => {
    if (editingText.trim() === '') {
      // Don't save empty tasks, just delete them
      handleDeleteTask(id);
    } else {
      setTasks(tasks.map(task => task.id === id ? { ...task, text: editingText } : task));
    }
    setEditingId(null);
    setEditingText('');
  };

  const handleCancelEdit = () => {
    setEditingId(null);
    setEditingText('');
  };

  return (
    <div style={{ padding: '2rem', fontFamily: 'Arial' }}>
      <h1>To-Do List</h1>
      <button onClick={handleAddTask}>Add</button>

      <ul>
        {tasks.map(task => (
          <li key={task.id} style={{ marginBottom: '0.5rem' }}>
            {editingId === task.id ? (
              <>
                <input
                  type="text"
                  value={editingText}
                  onChange={handleEditChange}
                  autoFocus
                  onKeyDown={(e) => {
                    if (e.key === 'Enter') {
                      handleSaveTask(task.id);
                    } else if (e.key === 'Escape') {
                      handleCancelEdit();
                    }
                  }}
                  style={{ marginRight: '0.5rem' }}
                />
                <button onClick={() => handleSaveTask(task.id)}>Save</button>
                <button onClick={handleCancelEdit} style={{ marginLeft: '0.5rem' }}>Cancel</button>
              </>
            ) : (
              <>
                {task.text}{' '}
                <button onClick={() => {
                  setEditingId(task.id);
                  setEditingText(task.text);
                }}>Edit</button>{' '}
                <button onClick={() => handleDeleteTask(task.id)}>Delete</button>
              </>
            )}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default App;
