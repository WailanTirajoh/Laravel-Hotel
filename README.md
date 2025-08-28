# Laravel Hotel - Admin Dashboard

Laravel Hotel is a modern, web application built with Laravel 12, featuring a stunning admin dashboard UI and enhanced with Reverb (Laravel WebSockets-compatible) for real-time notification experiences.

## 🖼️ Screenshots

<img width="1919" height="943" alt="image" src="https://github.com/user-attachments/assets/f14318c7-f8ee-4fa0-a2be-8e3dac36cf47" />

<img width="1919" height="943" alt="image" src="https://github.com/user-attachments/assets/ffbb1092-49dd-4e71-bb67-049f17e4d40e" />

<img width="1919" height="940" alt="image" src="https://github.com/user-attachments/assets/7499816a-0a24-4866-9f15-70d0b335aa85" />



## 🚀 Installation

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/MariaDB

### Database Setup

Create a new database:

```bash
mysql -u root -p
```

```sql
CREATE DATABASE hotel_app;
EXIT;
```

### Installation Steps

1. **Clone & Configure**

```bash
git clone https://github.com/WailanTirajoh/Laravel-Hotel.git
cd Laravel-Hotel
cp .env.example .env
```

2. **Install Dependencies**

```bash
composer install
npm install
```

3. **Generate Assets**

```bash
npm run build  # For production
# OR
npm run dev    # For development
```

4. **Setup Application**

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

5. **Start Services**

```bash
# Terminal 1: Application Server
php artisan serve

# Terminal 2: Reverb Server (for real-time notifications)
php artisan reverb:start
```

## 🔐 Demo Login

Access the admin dashboard with seeded demo accounts:

- **Email**: <demo@example.com>
- **Password**: demo_pass

> **Note**: Use the database seeders to create demo accounts, or check your `.env` file for configured test credentials.

## 🏗️ Architecture & Features

### 📊 Dashboard Modules

#### **Dashboard**

- Real-time guest statistics with animated counters
- Monthly charts with Chart.js integration
- Today's guest overview with table design
- Quick action buttons for common tasks
- Welcome message with current date/time

#### **Transaction Management**

- Complete reservation workflow with step-by-step process
- Payment tracking with status badges
- Down payment system (15% minimum)
- Real-time email and push notifications
- invoice generation

#### **Customer Management**

- CRUD operations with forms
- Advanced search and pagination
- Customer profile pages with activity history
- Avatar integration with fallback images
- Relationship tracking with transactions

#### **Room Management**

- Multi-level room management (Rooms, Types, Status, Facilities)
- image galleries
- Availability checking system
- Capacity-based room recommendations
- Status tracking with color-coded indicators

#### **User Management** (Super Admin Only)

- Role-based access control (Super, Admin, Customer)
- User activity logging with Spatie ActivityLog
- user profiles
- Permission management

### 🔔 Real-time Features

- Reverb notifications for new reservations
- Live dashboard updates
- Push notifications for staff
- Real-time payment status updates

### 📱 UI Components

#### **Modern Navigation**

- Sleek sidebar with gradient background
- Tooltip-enabled navigation icons
- Dropdown menus with smooth animations
- user profile dropdown

#### **Enhanced Forms**

- Floating labels with smooth transitions
- validation styling
- Select2 integration for dropdowns
- Date pickers with modern styling

#### **Data Visualization**

- tables with hover effects
- Chart.js integration for analytics
- Progress bars and status indicators
- badge system

## 🎨 Design System

### Color Palette

- **Primary**: `#2563eb` (Blue)
- **Success**: `#10b981` (Success Green)  
- **Warning**: `#f59e0b` (Warning Amber)
- **Danger**: `#ef4444` (Error Red)
- **Light**: `#f8fafc` (Background Light)
- **Dark**: `#1e293b` (Text Dark)

### Typography

- **Primary Font**: Inter (400, 500, 600, 700)
- **Fallback**: Nunito, sans-serif
- **Size Scale**: 0.875rem base with 1.6 line height

### Components

- **Cards**: 12px border radius with subtle shadows
- **Buttons**: gradients with hover effects
- **Forms**: Floating labels with focus states
- **Tables**: Hover effects with styling

## 📋 Business Logic

### Reservation Workflow

1. **Customer Registration**: Admin creates/selects customer profile
2. **Room Selection**: System recommends available rooms based on:
   - Date range availability
   - Guest capacity requirements  
   - Room type preferences
3. **Confirmation**: Review booking details and pricing
4. **Payment**: Minimum 15% down payment required
5. **Check-in/Check-out**: Status tracking throughout stay

### Payment System

- Down payment calculation (15% minimum)
- Balance tracking and payment completion
- invoice generation
- Payment history with status indicators

### Notification System

- Real-time Reverb notifications
- Email notifications for important events
- Push notifications for mobile devices
- Activity logging for audit trails

## 🗄️ Database Schema

![ERD](https://github.com/WailanTirajoh/Laravel-Hotel/blob/main/erd.PNG?raw=true)

### Key Relationships

- **Users** → **Customers** (1:1)
- **Customers** → **Transactions** (1:N)
- **Rooms** → **Transactions** (1:N)  
- **Transactions** → **Payments** (1:N)
- **Rooms** → **Types** (N:1)
- **Rooms** → **Status** (N:1)

## 🔧 Technical Stack

### Backend

- **Laravel 12**: Latest PHP framework
- **PHP 8.2+**: Modern PHP features
- **MySQL**: Reliable database system
- **Laravel Reverb**: WebSocket server
- **Spatie Packages**: Activity logging and more

### Frontend  

- **Bootstrap 5**: Modern CSS framework
- **Font Awesome 6**: icon set
- **Chart.js 4**: Data visualization
- **Select2**: Enhanced select dropdowns
- **DataTables**: table management
- **SweetAlert2**: Beautiful alerts and modals

### Development Tools

- **Vite**: Modern build tool
- **Sass**: Advanced CSS preprocessing  
- **Laravel Pint**: Code formatting
- **PHPUnit**: Testing framework

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

**Wailan Tirajoh**

- GitHub: [@WailanTirajoh](https://github.com/WailanTirajoh)
- Instagram: [@tirajoh](https://www.instagram.com/tirajoh/)
- Facebook: [tirajohw](https://www.facebook.com/tirajohw/)

---

### 🎯 Perfect for

- Hotel and hospitality management
- Learning Laravel development
- dashboard implementations
- Real-time web application examples
- Modern UI/UX design patterns

**Built with ❤️ using Laravel 12 and modern web technologies.**
