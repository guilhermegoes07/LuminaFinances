-- Create database if not exists
SELECT 'CREATE DATABASE financial_manager'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'financial_manager');

-- Create user if not exists
DO
$do$
BEGIN
   IF NOT EXISTS (
      SELECT FROM pg_catalog.pg_roles
      WHERE  rolname = 'financial_user') THEN
      CREATE USER financial_user WITH PASSWORD 'financial_password';
   END IF;
END
$do$;

-- Grant privileges
GRANT ALL PRIVILEGES ON DATABASE financial_manager TO financial_user;
