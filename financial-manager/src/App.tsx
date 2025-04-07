import { BrowserRouter } from 'react-router-dom';
import { AppProvider } from './context/AppContext';
import Router from './routes';

function App() {
  return (
    <BrowserRouter>
      <AppProvider>
        <Router />
      </AppProvider>
    </BrowserRouter>
  );
}

export default App;
