import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Drug {
    id: number;
    name: string;
    category: string;
    price: number;
    stock_quantity: number;
}

interface Props {
    drugs: Drug[];
    categories: string[];
    filters: {
        search?: string;
        category?: string;
        status?: string;
    };
    [key: string]: unknown;
}

// eslint-disable-next-line no-empty-pattern
export default function DrugsIndex({}: Props) {
    return (
        <AppShell>
            <Head title="Drug Inventory - PharmaCare" />

            <div className="space-y-6">
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold">📦 Drug Inventory Management</h1>
                        <p className="text-gray-600 mt-2">Manage drug stock, pricing, and inventory levels</p>
                    </div>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>🚧 Coming Soon</CardTitle>
                        <CardDescription>Drug inventory management features are under development</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">📦</div>
                            <h3 className="text-xl font-semibold mb-2">Drug Inventory System</h3>
                            <p className="text-gray-600 mb-6">
                                This feature will provide comprehensive drug inventory management 
                                with stock tracking, expiry monitoring, and automated reorder alerts.
                            </p>
                            <div className="bg-blue-50 p-4 rounded-lg">
                                <h4 className="font-semibold mb-2">Planned Features:</h4>
                                <ul className="text-left text-sm space-y-1">
                                    <li>• Complete drug catalog with generic/brand names</li>
                                    <li>• Stock quantity tracking and low stock alerts</li>
                                    <li>• Expiry date monitoring and disposal tracking</li>
                                    <li>• Batch number management for recalls</li>
                                    <li>• Prescription requirements and controlled substances</li>
                                    <li>• Category-based organization and search</li>
                                </ul>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppShell>
    );
}