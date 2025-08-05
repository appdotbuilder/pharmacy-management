import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Prescription {
    id: number;
    prescription_number: string;
    customer: {
        name: string;
    };
}

interface Props {
    prescriptions: Prescription[];
    [key: string]: unknown;
}

// eslint-disable-next-line no-empty-pattern
export default function PrescriptionsIndex({}: Props) {
    return (
        <AppShell>
            <Head title="Prescriptions - PharmaCare" />

            <div className="space-y-6">
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold">📋 Prescription Management</h1>
                        <p className="text-gray-600 mt-2">Track and fulfill patient prescriptions</p>
                    </div>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>🚧 Coming Soon</CardTitle>
                        <CardDescription>Prescription management features are under development</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">📋</div>
                            <h3 className="text-xl font-semibold mb-2">Prescription Processing System</h3>
                            <p className="text-gray-600 mb-6">
                                This feature will handle the complete prescription workflow from 
                                receipt to fulfillment with doctor verification and patient safety checks.
                            </p>
                            <div className="bg-green-50 p-4 rounded-lg">
                                <h4 className="font-semibold mb-2">Planned Features:</h4>
                                <ul className="text-left text-sm space-y-1">
                                    <li>• Digital prescription intake and processing</li>
                                    <li>• Doctor verification and licensing checks</li>
                                    <li>• Drug interaction and allergy warnings</li>
                                    <li>• Partial filling and refill tracking</li>
                                    <li>• Prescription status management</li>
                                    <li>• Insurance verification and billing</li>
                                </ul>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppShell>
    );
}