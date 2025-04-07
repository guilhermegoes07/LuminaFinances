import { Request, Response } from 'express';
import { AuthService } from '../services/auth.service';

export class AuthController {
  private authService: AuthService;

  constructor() {
    this.authService = new AuthService();
  }

  async register(req: Request, res: Response): Promise<void> {
    try {
      const { name, email, password } = req.body;
      const user = await this.authService.register(name, email, password);
      res.status(201).json({ message: 'User created successfully', user });
    } catch (error) {
      res.status(500).json({ message: 'Error creating user', error });
    }
  }

  async login(req: Request, res: Response): Promise<void> {
    try {
      const { email, password } = req.body;
      const token = await this.authService.login(email, password);

      if (!token) {
        res.status(401).json({ message: 'Invalid credentials' });
        return;
      }

      res.json({ token });
    } catch (error) {
      res.status(500).json({ message: 'Error during login', error });
    }
  }
}
