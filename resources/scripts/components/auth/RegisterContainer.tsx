import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import LoginFormContainer from '@/components/auth/LoginFormContainer';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';
import useFlash from '@/plugins/useFlash';
import Field from '@/components/elements/Field';
import Label from '@/components/elements/Label';
import { KeyIcon, UserIcon, MailIcon, EyeIcon, EyeOffIcon } from '@heroicons/react/solid';
import { Formik, FormikHelpers } from 'formik';
import { object, string, ref as yupRef } from 'yup';
import http from '@/api/http';

const BOT = 'MERLINCLANHOSTINGBOT';
const CHANNEL = '@pappylung';
const CHANNEL_URL = 'https://t.me/pappylung';

interface Values {
    email: string;
    username: string;
    name_first: string;
    name_last: string;
    password: string;
    password_confirmation: string;
}

const StepDot = ({ n, active, done }: { n: number; active: boolean; done: boolean }) => (
    <div
        css={tw`flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold transition-all duration-300`}
        style={{
            background: done
                ? 'linear-gradient(135deg,#22c55e,#16a34a)'
                : active
                ? 'linear-gradient(135deg,#8B5CF6,#06B6D4)'
                : 'rgba(255,255,255,0.08)',
            color: active || done ? '#fff' : 'rgba(255,255,255,0.3)',
            boxShadow: active ? '0 0 20px rgba(139,92,246,0.4)' : 'none',
        }}
    >
        {done ? '✓' : n}
    </div>
);

export default function RegisterContainer() {
    const { clearFlashes } = useFlash();
    const [step, setStep] = useState<'telegram' | 'form' | 'done'>('telegram');
    const [telegramId, setTelegramId] = useState('');
    const [verifying, setVerifying] = useState(false);
    const [telegramError, setTelegramError] = useState('');
    const [show, setShow] = useState(false);
    const [submitting, setSubmitting] = useState(false);

    const verifyTelegram = async () => {
        if (!telegramId.trim()) {
            setTelegramError('Please enter your Telegram User ID.');
            return;
        }
        setVerifying(true);
        setTelegramError('');
        try {
            const { data } = await http.post('/auth/register/verify-telegram', {
                telegram_id: telegramId.trim(),
            });
            if (data.is_member) {
                setStep('form');
            } else {
                setTelegramError(`You must join ${CHANNEL} on Telegram first, then come back and verify.`);
            }
        } catch {
            setTelegramError('Network error. Please try again.');
        } finally {
            setVerifying(false);
        }
    };

    const onSubmit = async (values: Values, { setErrors }: FormikHelpers<Values>) => {
        clearFlashes();
        setSubmitting(true);
        try {
            const { data } = await http.post('/auth/register', {
                ...values,
                telegram_id: telegramId,
            });
            if (data.success) {
                setStep('done');
            }
        } catch (err: any) {
            const errors = err?.response?.data?.errors || {};
            const mapped: Record<string, string> = {};
            Object.keys(errors).forEach((k) => {
                mapped[k] = errors[k][0];
            });
            setErrors(mapped);
        } finally {
            setSubmitting(false);
        }
    };

    const StepBar = () => (
        <div css={tw`flex items-center gap-2 mb-5`}>
            <StepDot n={1} active={step === 'telegram'} done={step === 'form' || step === 'done'} />
            <div
                css={tw`flex-1 h-px transition-all duration-500`}
                style={{
                    background:
                        step !== 'telegram'
                            ? 'linear-gradient(90deg,#8B5CF6,#06B6D4)'
                            : 'rgba(255,255,255,0.1)',
                }}
            />
            <StepDot n={2} active={step === 'form'} done={step === 'done'} />
        </div>
    );

    if (step === 'done') {
        return (
            <LoginFormContainer title='Account Created!' css={tw`w-full flex`}>
                <div css={tw`text-center py-4`}>
                    <div css={tw`text-5xl mb-4`}>🎉</div>
                    <p css={tw`text-sm mb-2`} style={{ color: 'rgba(255,255,255,0.7)' }}>
                        Your MerlinHost account is ready. Check your Telegram for a welcome message!
                    </p>
                    <div css={tw`mt-6`}>
                        <Link to='/auth/login'>
                            <Button css={tw`w-full !py-3`}>Go to Login →</Button>
                        </Link>
                    </div>
                </div>
            </LoginFormContainer>
        );
    }

    if (step === 'telegram') {
        return (
            <LoginFormContainer title='Join MerlinHost' css={tw`w-full flex`}>
                <StepBar />
                <div
                    css={tw`rounded-xl p-4 mb-4`}
                    style={{ background: 'rgba(139,92,246,0.08)', border: '1px solid rgba(139,92,246,0.25)' }}
                >
                    <p css={tw`text-xs font-semibold mb-1`} style={{ color: '#a78bfa' }}>
                        Step 1 — Join our Telegram Channel
                    </p>
                    <p css={tw`text-xs mb-3`} style={{ color: 'rgba(255,255,255,0.5)' }}>
                        You must be a member of{' '}
                        <strong style={{ color: '#a78bfa' }}>{CHANNEL}</strong> to register on MerlinHost.
                    </p>
                    <a
                        href={CHANNEL_URL}
                        target='_blank'
                        rel='noreferrer'
                        css={tw`flex items-center justify-center gap-2 py-2 px-4 rounded-lg text-sm font-bold no-underline`}
                        style={{ background: 'linear-gradient(135deg,#8B5CF6,#06B6D4)', color: '#fff' }}
                    >
                        ✈️ Join {CHANNEL} on Telegram →
                    </a>
                </div>
                <div
                    css={tw`rounded-xl p-4 mb-4`}
                    style={{ background: 'rgba(255,255,255,0.03)', border: '1px solid rgba(255,255,255,0.08)' }}
                >
                    <p css={tw`text-xs font-semibold mb-1`} style={{ color: 'rgba(255,255,255,0.8)' }}>
                        Step 2 — Get your Telegram User ID
                    </p>
                    <p css={tw`text-xs mb-3`} style={{ color: 'rgba(255,255,255,0.45)' }}>
                        Message{' '}
                        <a href={`https://t.me/${BOT}`} target='_blank' rel='noreferrer' style={{ color: '#a78bfa' }}>
                            @{BOT}
                        </a>{' '}
                        the command{' '}
                        <code
                            style={{
                                background: 'rgba(255,255,255,0.1)',
                                padding: '1px 6px',
                                borderRadius: 4,
                                fontSize: 11,
                            }}
                        >
                            /myid
                        </code>{' '}
                        to get your numeric ID.
                    </p>
                    <input
                        type='text'
                        placeholder='Your Telegram User ID (e.g. 123456789)'
                        value={telegramId}
                        onChange={(e) => setTelegramId(e.target.value)}
                        onKeyDown={(e) => e.key === 'Enter' && verifyTelegram()}
                        css={tw`w-full rounded-lg px-3 py-2 text-sm`}
                        style={{
                            background: 'rgba(255,255,255,0.06)',
                            border: '1px solid rgba(255,255,255,0.12)',
                            color: '#fff',
                            outline: 'none',
                        }}
                    />
                </div>
                {telegramError && (
                    <div
                        css={tw`rounded-lg px-3 py-2 text-xs mb-3`}
                        style={{
                            background: 'rgba(239,68,68,0.1)',
                            border: '1px solid rgba(239,68,68,0.3)',
                            color: '#f87171',
                        }}
                    >
                        {telegramError}
                    </div>
                )}
                <Button css={tw`w-full !py-3`} onClick={verifyTelegram} disabled={verifying}>
                    {verifying ? 'Verifying...' : 'Verify Membership →'}
                </Button>
                <div css={tw`mt-4 text-center`}>
                    <Link
                        to='/auth/login'
                        css={tw`text-sm text-reviactyl/80 no-underline hover:text-reviactyl/50`}
                    >
                        Already have an account? Login
                    </Link>
                </div>
            </LoginFormContainer>
        );
    }

    return (
        <Formik
            onSubmit={onSubmit}
            initialValues={{
                email: '',
                username: '',
                name_first: '',
                name_last: '',
                password: '',
                password_confirmation: '',
            }}
            validationSchema={object().shape({
                email: string().email('Must be a valid email').required('Email is required'),
                username: string().min(3, 'Min 3 characters').required('Username is required'),
                name_first: string().required('First name is required'),
                name_last: string().required('Last name is required'),
                password: string().min(8, 'Min 8 characters').required('Password is required'),
                password_confirmation: string()
                    .required('Please confirm your password')
                    .oneOf([yupRef('password')], 'Passwords do not match'),
            })}
        >
            {({ isSubmitting }) => (
                <LoginFormContainer title='Create Account' css={tw`w-full flex`}>
                    <StepBar />
                    <div
                        css={tw`flex items-center gap-2 mb-4 rounded-lg px-3 py-2`}
                        style={{ background: 'rgba(34,197,94,0.1)', border: '1px solid rgba(34,197,94,0.25)' }}
                    >
                        <span style={{ color: '#22c55e' }}>✓</span>
                        <span css={tw`text-xs font-semibold`} style={{ color: '#22c55e' }}>
                            Telegram verified — {CHANNEL}
                        </span>
                    </div>
                    <div css={tw`grid grid-cols-2 gap-3`}>
                        <Field
                            label='First Name'
                            placeholder='John'
                            name='name_first'
                            disabled={isSubmitting || submitting}
                        />
                        <Field
                            label='Last Name'
                            placeholder='Doe'
                            name='name_last'
                            disabled={isSubmitting || submitting}
                        />
                    </div>
                    <div css={tw`mt-3`}>
                        <Field
                            icon={MailIcon}
                            type='email'
                            label='Email Address'
                            placeholder='john@example.com'
                            name='email'
                            disabled={isSubmitting || submitting}
                        />
                    </div>
                    <div css={tw`mt-3`}>
                        <Field
                            icon={UserIcon}
                            label='Username'
                            placeholder='johndoe'
                            name='username'
                            disabled={isSubmitting || submitting}
                        />
                    </div>
                    <div css={tw`mt-3 relative`}>
                        <Label>Password</Label>
                        <Field
                            icon={KeyIcon}
                            type={show ? 'text' : 'password'}
                            name='password'
                            placeholder='••••••••'
                            disabled={isSubmitting || submitting}
                        />
                        <button
                            type='button'
                            css={tw`absolute border-l-2 top-[34px] right-[6px] py-2 p-1 border-gray-300 text-gray-300`}
                            onClick={() => setShow(!show)}
                        >
                            {show ? <EyeOffIcon className='h-5 w-5' /> : <EyeIcon className='h-5 w-5' />}
                        </button>
                    </div>
                    <div css={tw`mt-3`}>
                        <Field
                            icon={KeyIcon}
                            type={show ? 'text' : 'password'}
                            label='Confirm Password'
                            placeholder='••••••••'
                            name='password_confirmation'
                            disabled={isSubmitting || submitting}
                        />
                    </div>
                    <div css={tw`mt-5`}>
                        <Button css={tw`w-full !py-3`} type='submit' disabled={isSubmitting || submitting}>
                            {isSubmitting || submitting ? 'Creating Account...' : 'Create Account →'}
                        </Button>
                    </div>
                    <div css={tw`mt-4 text-center`}>
                        <Link
                            to='/auth/login'
                            css={tw`text-sm text-reviactyl/80 no-underline hover:text-reviactyl/50`}
                        >
                            Already have an account? Login
                        </Link>
                    </div>
                </LoginFormContainer>
            )}
        </Formik>
    );
}
