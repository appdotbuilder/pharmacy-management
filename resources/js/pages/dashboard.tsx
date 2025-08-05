import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Stats {
    total_drugs: number;
    low_stock_drugs: number;
    expired_drugs: number;
    total_customers: number;
    pending_prescriptions: number;
    today_sales: number;
    today_revenue: number;
}

interface Drug {
    id: number;
    name: string;
    stock_quantity: number;
    minimum_stock: number;
    unit: string;
}

interface Sale {
    id: number;
    sale_number: string;
    total_amount: number;
    customer?: {
        name: string;
    };
    user: {
        name: string;
    };
    created_at: string;
}

interface Prescription {
    id: number;
    prescription_number: string;
    customer: {
        name: string;
    };
    doctor_name: string;
    prescription_date: string;
}

interface Props {
    stats: Stats;
    recent_sales: Sale[];
    low_stock_drugs: Drug[];
    pending_prescriptions: Prescription[];
    user_role: string;
    [key: string]: unknown;
}

export default function Dashboard({ 
    stats, 
    recent_sales, 
    low_stock_drugs, 
    pending_prescriptions, 
    user_role 
}: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(amount);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString();
    };

    return (
        <AppShell>
            <Head title="Dashboard - PharmaCare" />

            <div className="space-y-6">
                {/* Welcome Header */}
                <div className="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-6 text-white">
                    <h1 className="text-2xl font-bold mb-2">
                        💊 Welcome to PharmaCare Dashboard
                    </h1>
                    <p className="text-blue-100">
                        {user_role === 'administrator' && '🔐 Administrator - Full system access'}
                        {user_role === 'pharmacist' && '⚕️ Pharmacist - Manage prescriptions and inventory'}
                        {user_role === 'cashier' && '💰 Cashier - Handle sales and customer service'}
                    </p>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Drugs</CardTitle>
                            <div className="text-2xl">💊</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.total_drugs}</div>
                            <p className="text-xs text-muted-foreground">Active in inventory</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Low Stock Alert</CardTitle>
                            <div className="text-2xl">⚠️</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-red-600">{stats.low_stock_drugs}</div>
                            <p className="text-xs text-muted-foreground">Items need reordering</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Today's Sales</CardTitle>
                            <div className="text-2xl">💰</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.today_sales}</div>
                            <p className="text-xs text-muted-foreground">
                                Revenue: {formatCurrency(stats.today_revenue)}
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Pending Prescriptions</CardTitle>
                            <div className="text-2xl">📋</div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-orange-600">{stats.pending_prescriptions}</div>
                            <p className="text-xs text-muted-foreground">Awaiting fulfillment</p>
                        </CardContent>
                    </Card>
                </div>

                {/* Quick Actions */}
                <Card>
                    <CardHeader>
                        <CardTitle>🚀 Quick Actions</CardTitle>
                        <CardDescription>Common pharmacy operations</CardDescription>
                    </CardHeader>
                    <CardContent className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        {(user_role === 'administrator' || user_role === 'pharmacist') && (
                            <Link href="/drugs">
                                <Button className="w-full h-16 flex flex-col">
                                    <div className="text-2xl mb-1">📦</div>
                                    <span>Manage Drugs</span>
                                </Button>
                            </Link>
                        )}
                        
                        {(user_role === 'administrator' || user_role === 'pharmacist') && (
                            <Link href="/prescriptions">
                                <Button className="w-full h-16 flex flex-col" variant="outline">
                                    <div className="text-2xl mb-1">📋</div>
                                    <span>Prescriptions</span>
                                </Button>
                            </Link>
                        )}
                        
                        <Link href="/sales">
                            <Button className="w-full h-16 flex flex-col" variant="outline">
                                <div className="text-2xl mb-1">💰</div>
                                <span>Record Sale</span>
                            </Button>
                        </Link>
                        
                        <Link href="/customers">
                            <Button className="w-full h-16 flex flex-col" variant="outline">
                                <div className="text-2xl mb-1">👥</div>
                                <span>Customers</span>
                            </Button>
                        </Link>
                    </CardContent>
                </Card>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Low Stock Alerts */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                ⚠️ Low Stock Alerts
                            </CardTitle>
                            <CardDescription>Items that need immediate attention</CardDescription>
                        </CardHeader>
                        <CardContent>
                            {low_stock_drugs.length > 0 ? (
                                <div className="space-y-3">
                                    {low_stock_drugs.slice(0, 5).map((drug) => (
                                        <div key={drug.id} className="flex justify-between items-center p-3 bg-red-50 rounded-lg border border-red-200">
                                            <div>
                                                <p className="font-medium">{drug.name}</p>
                                                <p className="text-sm text-gray-600">
                                                    Stock: {drug.stock_quantity} {drug.unit}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm text-red-600 font-medium">
                                                    Min: {drug.minimum_stock}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                    {low_stock_drugs.length > 5 && (
                                        <Link href="/drugs?filter=low_stock">
                                            <Button variant="outline" className="w-full">
                                                View All ({low_stock_drugs.length} items)
                                            </Button>
                                        </Link>
                                    )}
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-4">
                                    ✅ All items are well stocked
                                </p>
                            )}
                        </CardContent>
                    </Card>

                    {/* Recent Sales */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                📊 Recent Sales
                            </CardTitle>
                            <CardDescription>Latest transactions</CardDescription>
                        </CardHeader>
                        <CardContent>
                            {recent_sales.length > 0 ? (
                                <div className="space-y-3">
                                    {recent_sales.map((sale) => (
                                        <div key={sale.id} className="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                            <div>
                                                <p className="font-medium">#{sale.sale_number}</p>
                                                <p className="text-sm text-gray-600">
                                                    {sale.customer?.name || 'Walk-in'} • {sale.user.name}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-medium">{formatCurrency(sale.total_amount)}</p>
                                                <p className="text-sm text-gray-500">
                                                    {formatDate(sale.created_at)}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                    <Link href="/sales">
                                        <Button variant="outline" className="w-full">
                                            View All Sales
                                        </Button>
                                    </Link>
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-4">
                                    No sales recorded today
                                </p>
                            )}
                        </CardContent>
                    </Card>
                </div>

                {/* Pending Prescriptions */}
                {(user_role === 'administrator' || user_role === 'pharmacist') && (
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                📋 Pending Prescriptions
                            </CardTitle>
                            <CardDescription>Prescriptions awaiting fulfillment</CardDescription>
                        </CardHeader>
                        <CardContent>
                            {pending_prescriptions.length > 0 ? (
                                <div className="space-y-3">
                                    {pending_prescriptions.map((prescription) => (
                                        <div key={prescription.id} className="flex justify-between items-center p-3 bg-orange-50 rounded-lg border border-orange-200">
                                            <div>
                                                <p className="font-medium">#{prescription.prescription_number}</p>
                                                <p className="text-sm text-gray-600">
                                                    {prescription.customer.name} • Dr. {prescription.doctor_name}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm text-gray-500">
                                                    {formatDate(prescription.prescription_date)}
                                                </p>
                                                <Link href={`/prescriptions/${prescription.id}`}>
                                                    <Button size="sm" className="mt-1">
                                                        Process
                                                    </Button>
                                                </Link>
                                            </div>
                                        </div>
                                    ))}
                                    <Link href="/prescriptions">
                                        <Button variant="outline" className="w-full">
                                            View All Prescriptions
                                        </Button>
                                    </Link>
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-4">
                                    ✅ No pending prescriptions
                                </p>
                            )}
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppShell>
    );
}