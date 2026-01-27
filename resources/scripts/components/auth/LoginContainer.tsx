import React, { useEffect, useRef, useState } from 'react';
import { Link, RouteComponentProps } from 'react-router-dom';
import login from '@/api/auth/login';
import LoginFormContainer from '@/components/auth/LoginFormContainer';
import { useStoreState } from 'easy-peasy';
import { Formik, FormikHelpers } from 'formik';
import { object, string } from 'yup';
import Field from '@/components/elements/Field';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';
import Reaptcha from 'reaptcha';
import Turnstile from '@/components/elements/Turnstile';
import useFlash from '@/plugins/useFlash';
import Label from '@/components/elements/Label';
import { KeyIcon, UserIcon, EyeIcon, EyeOffIcon } from '@heroicons/react/solid';
import { useTranslation } from 'react-i18next';

interface Values {
    username: string;
    password: string;
}

const LoginContainer = ({ history }: RouteComponentProps) => {
    const { t } = useTranslation('auth');
    const ref = useRef<Reaptcha>(null);
    const [token, setToken] = useState('');
    const [show, setShow] = useState(false);

    const { clearFlashes, clearAndAddHttpError, addFlash } = useFlash();
    const { provider, recaptcha, turnstile } = useStoreState((state) => state.settings.data!.captcha);

    const socialSettings = window.SocialLoginConfiguration || { google: false, discord: false, github: false };

    useEffect(() => {
        clearFlashes();

        // @ts-expect-error this is valid
        const sessionFlashes = window.SessionFlashes;
        if (sessionFlashes) {
            if (sessionFlashes.error) {
                addFlash({ type: 'error', title: 'Error', message: sessionFlashes.error });
            }
            if (sessionFlashes.success) {
                addFlash({ type: 'success', title: 'Success', message: sessionFlashes.success });
            }
            if (sessionFlashes.info) {
                addFlash({ type: 'info', title: 'Info', message: sessionFlashes.info });
            }
            if (sessionFlashes.warning) {
                addFlash({ type: 'warning', title: 'Warning', message: sessionFlashes.warning });
            }
            // @ts-expect-error this is valid
            window.SessionFlashes = undefined;
        }
    }, []);

    const onSubmit = (values: Values, { setSubmitting }: FormikHelpers<Values>) => {
        clearFlashes();

        // If using reCAPTCHA and no token yet, execute captcha
        if (provider === 'recaptcha' && !token) {
            ref.current!.execute().catch((error) => {
                console.error(error);
                setSubmitting(false);
                clearAndAddHttpError({ error });
            });
            return;
        }

        // For Turnstile, the token is set automatically by the widget
        if (provider === 'turnstile' && !token) {
            setSubmitting(false);
            return;
        }

        login({ ...values, captchaToken: token, captchaProvider: provider })
            .then((response) => {
                if (response.complete) {
                    // @ts-expect-error this is valid
                    window.location = response.intended || '/';
                    return;
                }

                history.replace('/auth/login/checkpoint', { token: response.confirmationToken });
            })
            .catch((error) => {
                console.error(error);

                setToken('');
                if (ref.current) ref.current.reset();

                setSubmitting(false);
                clearAndAddHttpError({ error });
            });
    };

    return (
        <Formik
            onSubmit={onSubmit}
            initialValues={{ username: '', password: '' }}
            validationSchema={object().shape({
                username: string().required(t('username-required')),
                password: string().required(t('password-required')),
            })}
        >
            {({ isSubmitting, setSubmitting, submitForm }) => (
                <LoginFormContainer title={t('login-title')} css={tw`w-full flex`}>
                    <Field
                        icon={UserIcon}
                        type={'text'}
                        placeholder={t('username-label')}
                        label={t('username-label')}
                        name={'username'}
                        disabled={isSubmitting}
                    />
                    <div css={tw`mt-3`}>
                        <Label>{t('password-label')}</Label>
                        <div css={tw`relative`}>
                            <Field
                                icon={KeyIcon}
                                type={show ? 'text' : 'password'}
                                placeholder={t('password-label')}
                                name={'password'}
                                disabled={isSubmitting}
                            />
                            <button
                                type={'button'}
                                css={tw`absolute border-l-2 top-[10px] right-[6px] py-2 p-1 border-gray-300 text-gray-300`}
                                onClick={() => setShow(!show)}
                            >
                                {show ? <EyeOffIcon className='h-5 w-5' /> : <EyeIcon className='h-5 w-5' />}
                            </button>
                        </div>
                    </div>
                    <div css={tw`mt-6`}>
                        <Button css={tw`w-full !py-3`} type={'submit'} disabled={isSubmitting}>
                            {t('login-button')}
                        </Button>
                    </div>

                    <div css={tw`mt-4 grid grid-cols-1 gap-2`}>
                        <div css={tw`relative flex py-2 items-center`}>
                            <div css={tw`flex-grow border-t border-gray-600`}></div>
                            <span css={tw`flex-shrink mx-4 text-gray-400 text-xs`}>{t('social.or')}</span>
                            <div css={tw`flex-grow border-t border-gray-600`}></div>
                        </div>
                        {socialSettings.google && (
                            <a
                                href={'/auth/login/google'}
                                css={tw`w-full text-center p-2 rounded bg-red-600 text-gray-50 hover:bg-red-700 transition-colors duration-150 font-bold text-sm`}
                            >
                                {t('social.google')}
                            </a>
                        )}
                        {socialSettings.discord && (
                            <a
                                href={'/auth/login/discord'}
                                css={tw`w-full text-center p-2 rounded bg-indigo-600 text-gray-50 hover:bg-indigo-700 transition-colors duration-150 font-bold text-sm`}
                            >
                                {t('social.discord')}
                            </a>
                        )}
                        {socialSettings.github && (
                            <a
                                href={'/auth/login/github'}
                                css={tw`w-full text-center p-2 rounded bg-gray-700 text-gray-50 hover:bg-gray-800 transition-colors duration-150 font-bold text-sm`}
                            >
                                {t('social.github')}
                            </a>
                        )}
                    </div>
                    {provider === 'recaptcha' && (
                        <Reaptcha
                            ref={ref}
                            size={'invisible'}
                            sitekey={recaptcha.siteKey || '_invalid_key'}
                            onVerify={(response) => {
                                setToken(response);
                                submitForm();
                            }}
                            onExpire={() => {
                                setSubmitting(false);
                                setToken('');
                            }}
                        />
                    )}
                    {provider === 'turnstile' && (
                        <div css={tw`mt-4 flex justify-center`}>
                            <Turnstile
                                siteKey={turnstile.siteKey}
                                onVerify={(response) => setToken(response)}
                                onExpire={() => setToken('')}
                            />
                        </div>
                    )}
                    <div css={tw`mt-3 text-center`}>
                        <Link
                            to={'/auth/password'}
                            css={tw`text-sm text-reviactyl/80 tracking-wide no-underline hover:text-reviactyl/50`}
                        >
                            {t('forgot-password.label')}
                        </Link>
                    </div>
                </LoginFormContainer>
            )}
        </Formik>
    );
};

export default LoginContainer;
