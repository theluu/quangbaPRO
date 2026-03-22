import jsonServer from 'json-server';
import * as path from 'node:path';
import * as fs from 'node:fs';

const server = jsonServer.create();
const router = jsonServer.router('db.json');
const middlewares = jsonServer.defaults();

const readDataFile = (fileName) => {
  const dataPath = path.resolve(path.join('data', fileName));
  const data = fs.readFileSync(dataPath, 'utf8');
  return JSON.parse(data);
};

server.use(middlewares);
server.use(jsonServer.bodyParser);

// Các endpoint mock khác
server.get('/mock-api/:file', (req, res) => {
  try {
    const data = readDataFile(req.params.file);
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Internal Server Error' });
  }
});

server.use(router);
server.listen(3000, () => {
  console.log('JSON Server is running on port 3000');
});