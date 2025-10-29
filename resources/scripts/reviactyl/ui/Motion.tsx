import { motion, useReducedMotion, MotionProps } from "framer-motion";
import React from "react";

interface MotionDivProps extends MotionProps {
  children?: React.ReactNode;
  className?: string;
  hover?: boolean;
  delay?: number;
}

const Motion: React.FC<MotionDivProps> = ({
  children,
  className = "",
  hover = false,
  delay = 0,
  ...rest
}) => {
  const shouldReduceMotion = useReducedMotion();

  const baseAnimation = shouldReduceMotion
    ? {}
    : {
        initial: { opacity: 0, scale: 0.98 },
        animate: { opacity: 1, scale: 1 },
        transition: { duration: 0.3, delay, ease: "easeOut" },
      };

  const hoverEffect =
    hover && !shouldReduceMotion
      ? { whileHover: { scale: 1.02, y: -2 } }
      : {};

  return (
    <motion.div
      {...baseAnimation}
      {...hoverEffect}
      className={className}
      {...rest}
    >
      {children}
    </motion.div>
  );
};

export default Motion;
