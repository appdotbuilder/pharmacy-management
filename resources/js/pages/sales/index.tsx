import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Sale {
    id: number;
    sale_number: string;
    total_amount: number;
}

interface Props {
    sales: Sale[];
    [key: string]: unknown;
}

// eslint-disable-next-line no-empty-pattern
export default function SalesIndex({}: Props) {
    return (
        <AppShell>
            <Head title="Sales - PharmaCare" />

            <div className="space-y-6">
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold">💰 Sales Management</h1>
                        <p className="text-gray-600 mt-2">Record sales and manage transactions</p>
                    </div>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>🚧 Coming Soon</CardTitle>
                        <CardDescription>Sales management features are under development</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">💰</div>
                            <h3 className="text-xl font-semibold mb-2">Point of Sale System</h3>
                            <p className="text-gray-600 mb-6">
                                This feature will provide a complete point-of-sale system for 
                                recording transactions, managing payments, and generating receipts.
                            </p>
                            <div className="bg-purple-50 p-4 rounded-lg">
                                <h4 className="font-semibold mb-2">Planned Features:</h4>
                                <ul className="text-left text-sm space-y-1">
                                    <li>• Barcode scanning and drug lookup</li>
                                    <li>• Multiple payment method support</li>
                                    <li>• Tax calculation and discount application</li>
                                    <li>• Receipt printing and email delivery</li>
                                    <li>• Daily sales reporting and analytics</li>
                                    <li>• Inventory auto-deduction</li>
                                </ul>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppShell>
    );
}