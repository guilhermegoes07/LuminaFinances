import { Router, Request, Response } from 'express';
import { AuthController } from '../controllers/auth.controller';

const router = Router();
const authController = new AuthController();

router.post('/register', async (req: Request, res: Response) => {
  await authController.register(req, res);
});

router.post('/login', async (req: Request, res: Response) => {
  await authController.login(req, res);
});

// Logout
router.post('/logout', (_req: Request, res: Response) => {
  // Como estamos usando JWT, não precisamos fazer nada no backend
  // O frontend que deve remover o token
  res.status(200).json({ message: 'Logout realizado com sucesso' });
});

export default router;
