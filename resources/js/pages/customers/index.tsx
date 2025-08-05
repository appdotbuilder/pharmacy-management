import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Customer {
    id: number;
    name: string;
    email: string;
    phone: string;
}

interface Props {
    customers: Customer[];
    [key: string]: unknown;
}

// eslint-disable-next-line no-empty-pattern
export default function CustomersIndex({}: Props) {
    return (
        <AppShell>
            <Head title="Customers - PharmaCare" />

            <div className="space-y-6">
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold">👥 Customer Management</h1>
                        <p className="text-gray-600 mt-2">Manage customer profiles and medical information</p>
                    </div>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>🚧 Coming Soon</CardTitle>
                        <CardDescription>Customer management features are under development</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">🔄</div>
                            <h3 className="text-xl font-semibold mb-2">Customer Management System</h3>
                            <p className="text-gray-600 mb-6">
                                This feature will include customer profiles, medical history, 
                                allergy tracking, and prescription history management.
                            </p>
                            <div className="bg-blue-50 p-4 rounded-lg">
                                <h4 className="font-semibold mb-2">Planned Features:</h4>
                                <ul className="text-left text-sm space-y-1">
                                    <li>• Complete customer profiles with contact information</li>
                                    <li>• Medical history and allergy tracking</li>
                                    <li>• Prescription purchase history</li>
                                    <li>• Customer search and filtering</li>
                                    <li>• HIPAA-compliant data management</li>
                                </ul>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppShell>
    );
}