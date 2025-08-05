import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
        } | null;
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    return (
        <>
            <Head title="PharmaCare - Complete Pharmacy Management System" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
                {/* Navigation */}
                <nav className="bg-white shadow-sm border-b">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center h-16">
                            <div className="flex items-center">
                                <div className="text-2xl font-bold text-blue-600">
                                    💊 PharmaCare
                                </div>
                            </div>
                            <div className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link href="/dashboard">
                                        <Button>Dashboard</Button>
                                    </Link>
                                ) : (
                                    <div className="flex space-x-4">
                                        <Link href="/login">
                                            <Button variant="outline">Login</Button>
                                        </Link>
                                        <Link href="/register">
                                            <Button>Get Started</Button>
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </nav>

                {/* Hero Section */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                    <div className="text-center">
                        <h1 className="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                            💊 Complete Pharmacy
                            <span className="text-blue-600 block">Management System</span>
                        </h1>
                        <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                            Streamline your pharmacy operations with comprehensive drug inventory management, 
                            prescription tracking, sales recording, and customer data management. 
                            Built for modern pharmacies with multi-user role support.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            {auth.user ? (
                                <Link href="/dashboard">
                                    <Button size="lg" className="text-lg px-8 py-3">
                                        🏠 Go to Dashboard
                                    </Button>
                                </Link>
                            ) : (
                                <>
                                    <Link href="/register">
                                        <Button size="lg" className="text-lg px-8 py-3">
                                            🚀 Start Free Trial
                                        </Button>
                                    </Link>
                                    <Link href="/login">
                                        <Button variant="outline" size="lg" className="text-lg px-8 py-3">
                                            👤 Login
                                        </Button>
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </div>

                {/* Features Grid */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div className="text-center mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 mb-4">
                            🌟 Powerful Features for Modern Pharmacies
                        </h2>
                        <p className="text-lg text-gray-600">
                            Everything you need to manage your pharmacy efficiently
                        </p>
                    </div>

                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {/* Drug Stock Management */}
                        <div className="bg-white rounded-lg shadow-lg p-6 border-t-4 border-blue-500">
                            <div className="text-4xl mb-4">📦</div>
                            <h3 className="text-xl font-semibold mb-3">Drug Stock Management</h3>
                            <ul className="text-gray-600 space-y-2">
                                <li>• Complete drug inventory tracking</li>
                                <li>• Low stock notifications</li>
                                <li>• Expiry date monitoring</li>
                                <li>• Batch number management</li>
                                <li>• Category-based organization</li>
                            </ul>
                        </div>

                        {/* Prescription Tracking */}
                        <div className="bg-white rounded-lg shadow-lg p-6 border-t-4 border-green-500">
                            <div className="text-4xl mb-4">📋</div>
                            <h3 className="text-xl font-semibold mb-3">Prescription Management</h3>
                            <ul className="text-gray-600 space-y-2">
                                <li>• Digital prescription processing</li>
                                <li>• Doctor verification system</li>
                                <li>• Prescription fulfillment tracking</li>
                                <li>• Dosage instructions management</li>
                                <li>• Treatment duration tracking</li>
                            </ul>
                        </div>

                        {/* Sales Recording */}
                        <div className="bg-white rounded-lg shadow-lg p-6 border-t-4 border-purple-500">
                            <div className="text-4xl mb-4">💰</div>
                            <h3 className="text-xl font-semibold mb-3">Sales & Billing</h3>
                            <ul className="text-gray-600 space-y-2">
                                <li>• Point of sale system</li>
                                <li>• Multiple payment methods</li>
                                <li>• Tax and discount handling</li>
                                <li>• Receipt generation</li>
                                <li>• Sales analytics & reports</li>
                            </ul>
                        </div>

                        {/* Customer Management */}
                        <div className="bg-white rounded-lg shadow-lg p-6 border-t-4 border-orange-500">
                            <div className="text-4xl mb-4">👥</div>
                            <h3 className="text-xl font-semibold mb-3">Customer Data Management</h3>
                            <ul className="text-gray-600 space-y-2">
                                <li>• Comprehensive customer profiles</li>
                                <li>• Medical history tracking</li>
                                <li>• Allergy management</li>
                                <li>• Purchase history</li>
                                <li>• Contact information</li>
                            </ul>
                        </div>

                        {/* User Roles */}
                        <div className="bg-white rounded-lg shadow-lg p-6 border-t-4 border-red-500">
                            <div className="text-4xl mb-4">🔐</div>
                            <h3 className="text-xl font-semibold mb-3">Multi-User Role System</h3>
                            <ul className="text-gray-600 space-y-2">
                                <li>• <strong>Administrator:</strong> Full system access</li>
                                <li>• <strong>Pharmacist:</strong> Stock & prescriptions</li>
                                <li>• <strong>Cashier:</strong> Sales & customer data</li>
                                <li>• Role-based permissions</li>
                                <li>• Secure user management</li>
                            </ul>
                        </div>

                        {/* Reporting */}
                        <div className="bg-white rounded-lg shadow-lg p-6 border-t-4 border-teal-500">
                            <div className="text-4xl mb-4">📊</div>
                            <h3 className="text-xl font-semibold mb-3">Analytics & Reporting</h3>
                            <ul className="text-gray-600 space-y-2">
                                <li>• Daily sales reports</li>
                                <li>• Revenue analytics</li>
                                <li>• Stock level monitoring</li>
                                <li>• Prescription statistics</li>
                                <li>• Business insights</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {/* Workflow Section */}
                <div className="bg-gray-50 py-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">
                                🔄 Streamlined Workflows
                            </h2>
                            <p className="text-lg text-gray-600">
                                Optimized processes for common pharmacy operations
                            </p>
                        </div>

                        <div className="grid md:grid-cols-3 gap-8">
                            <div className="bg-white rounded-lg p-6 shadow-md">
                                <div className="text-3xl mb-4 text-center">📝</div>
                                <h3 className="text-xl font-semibold mb-3 text-center">Prescription Fulfillment</h3>
                                <div className="text-gray-600 text-center">
                                    <p>Receive → Verify → Dispense → Record</p>
                                    <p className="text-sm mt-2">Complete workflow from prescription receipt to customer delivery</p>
                                </div>
                            </div>

                            <div className="bg-white rounded-lg p-6 shadow-md">
                                <div className="text-3xl mb-4 text-center">📦</div>
                                <h3 className="text-xl font-semibold mb-3 text-center">Stock Reordering</h3>
                                <div className="text-gray-600 text-center">
                                    <p>Monitor → Alert → Order → Receive</p>
                                    <p className="text-sm mt-2">Automated low stock notifications and reorder management</p>
                                </div>
                            </div>

                            <div className="bg-white rounded-lg p-6 shadow-md">
                                <div className="text-3xl mb-4 text-center">🚨</div>
                                <h3 className="text-xl font-semibold mb-3 text-center">Low Stock Notifications</h3>
                                <div className="text-gray-600 text-center">
                                    <p>Check → Notify → Action → Update</p>
                                    <p className="text-sm mt-2">Real-time alerts for inventory management</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* CTA Section */}
                <div className="bg-blue-600 py-16">
                    <div className="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                        <h2 className="text-3xl font-bold text-white mb-4">
                            Ready to Transform Your Pharmacy?
                        </h2>
                        <p className="text-xl text-blue-100 mb-8">
                            Join modern pharmacies using PharmaCare to streamline operations, 
                            improve customer service, and increase efficiency.
                        </p>
                        {auth.user ? (
                            <Link href="/dashboard">
                                <Button size="lg" variant="secondary" className="text-lg px-8 py-3">
                                    🏠 Access Your Dashboard
                                </Button>
                            </Link>
                        ) : (
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link href="/register">
                                    <Button size="lg" variant="secondary" className="text-lg px-8 py-3">
                                        🚀 Start Your Free Trial
                                    </Button>
                                </Link>
                                <Link href="/login">
                                    <Button size="lg" variant="outline" className="text-lg px-8 py-3 text-white border-white hover:bg-white hover:text-blue-600">
                                        👤 Login to Existing Account
                                    </Button>
                                </Link>
                            </div>
                        )}
                    </div>
                </div>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-8">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <div className="text-2xl font-bold mb-2">💊 PharmaCare</div>
                        <p className="text-gray-400">
                            Complete Pharmacy Management System - Streamlining healthcare operations
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}