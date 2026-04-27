# Test Task AbeloHost

Test Task for AbeloHost
## Quick Start

1. Start the development environment:
   ```bash
   docker-compose up -d
   ```

3. Configure SSL and hosts file:
    - Add to /etc/hosts: `127.0.0.1 ttahost.loc`


4. Install dependencies:
   ```bash
   docker exec ttahost_wes_php composer install
   ```

5. Additional setup:
    - Seed database ...


6. Access at http://ttahost.loc
