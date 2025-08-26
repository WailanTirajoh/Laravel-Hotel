# Laravel Hotel - Professional Admin Dashboard

Laravel Hotel is a modern, professional web application built with Laravel 12, featuring a stunning admin dashboard UI and enhanced with Laravel WebSockets for real-time notification experiences.

## ✨ What's New in v2.0

### 🎨 Professional UI Redesign

- **Modern Dashboard**: Clean, professional admin interface with gradient backgrounds and smooth animations
- **Enhanced Navigation**: Intuitive sidebar with hover effects and improved user experience
- **Professional Cards**: Beautiful card components with shadows and hover effects
- **Improved Typography**: Inter font family for better readability
- **Responsive Design**: Optimized for all devices and screen sizes
- **Professional Login**: Stunning glassmorphism login page with animated elements

### 🔧 Technical Upgrades

- **Laravel 12**: Latest Laravel framework with all new features
- **Bootstrap 5**: Updated UI framework with modern components
- **Font Awesome 6**: Latest icon set for better visual appeal
- **Chart.js 4**: Enhanced data visualization
- **Professional Color Scheme**: Blue-based palette for trust and reliability

### 📱 User Experience Improvements

- **Smooth Animations**: CSS transitions and hover effects throughout
- **Loading States**: Professional loading indicators
- **Toast Notifications**: Enhanced notification system
- **Interactive Elements**: Hover states and micro-interactions
- **Professional Badges**: Color-coded status indicators

## 🖼️ Screenshots

### Modern Dashboard

![Dashboard](https://github.com/WailanTirajoh/laravel_hotel/blob/main/example.png?raw=true)

### Professional Reservation Interface

![Reservation](https://github.com/WailanTirajoh/laravel_hotel/blob/main/example-b.png?raw=true)

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
git clone https://github.com/WailanTirajoh/laravel_hotel.git
cd laravel_hotel
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

# Terminal 2: WebSocket Server (for real-time notifications)
php artisan reverb:start
```

## 🔐 Demo Login

Access the professional admin dashboard:

- **Email**: <wailantirajoh@gmail.com>
- **Password**: wailan

## 🏗️ Architecture & Features

### 📊 Dashboard Modules

#### **Professional Dashboard**

- Real-time guest statistics with animated counters
- Monthly charts with Chart.js integration
- Today's guest overview with professional table design
- Quick action buttons for common tasks
- Welcome message with current date/time

#### **Transaction Management**

- Complete reservation workflow with step-by-step process
- Payment tracking with professional status badges
- Down payment system (15% minimum)
- Real-time email and push notifications
- Professional invoice generation

#### **Customer Management**

- CRUD operations with professional forms
- Advanced search and pagination
- Customer profile pages with activity history
- Avatar integration with fallback images
- Relationship tracking with transactions

#### **Room Management**

- Multi-level room management (Rooms, Types, Status, Facilities)
- Professional image galleries
- Availability checking system
- Capacity-based room recommendations
- Status tracking with color-coded indicators

#### **User Management** (Super Admin Only)

- Role-based access control (Super, Admin, Customer)
- User activity logging with Spatie ActivityLog
- Professional user profiles
- Permission management

### 🔔 Real-time Features

- WebSocket notifications for new reservations
- Live dashboard updates
- Push notifications for staff
- Real-time payment status updates

### 📱 Professional UI Components

#### **Modern Navigation**

- Sleek sidebar with gradient background
- Tooltip-enabled navigation icons
- Dropdown menus with smooth animations
- Professional user profile dropdown

#### **Enhanced Forms**

- Floating labels with smooth transitions
- Professional validation styling
- Select2 integration for dropdowns
- Date pickers with modern styling

#### **Data Visualization**

- Professional tables with hover effects
- Chart.js integration for analytics
- Progress bars and status indicators
- Professional badge system

## 🎨 Design System

### Color Palette

- **Primary**: `#2563eb` (Professional Blue)
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
- **Buttons**: Professional gradients with hover effects
- **Forms**: Floating labels with focus states
- **Tables**: Hover effects with professional styling

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
- Professional invoice generation
- Payment history with status indicators

### Notification System

- Real-time WebSocket notifications
- Email notifications for important events
- Push notifications for mobile devices
- Activity logging for audit trails

## 🗄️ Database Schema

![ERD](https://github.com/WailanTirajoh/laravel_hotel/blob/main/erd.PNG?raw=true)

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
- **Font Awesome 6**: Professional icon set
- **Chart.js 4**: Data visualization
- **Select2**: Enhanced select dropdowns
- **DataTables**: Professional table management
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
- Professional dashboard implementations
- Real-time web application examples
- Modern UI/UX design patterns

**Built with ❤️ using Laravel 12 and modern web technologies.**
